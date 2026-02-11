<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\MpesaPayment;
use App\Services\MpesaServices;
use App\Models\LoanApplication;
use App\Models\LoanRepayment;
use App\Models\LoanDisbursement;
use App\Enums\PaymentChannel;
use App\Enums\PaymentStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    protected MpesaServices $mpesa;

    public function __construct(MpesaServices $mpesa)
    {
        $this->mpesa = $mpesa;
    }
public function stkPush(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'phonenumber' => 'required|string',
        'account_number' => 'required|integer',
    ]);

    $amount =  round($request->amount);
    $phone = preg_replace('/^0/', '254', $request->phonenumber);
    $loanId = $request->account_number;

    $loan = LoanApplication::findOrFail($loanId);

    DB::beginTransaction();

    try {
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'amount' => $amount,
            'channel' => PaymentChannel::MPESA,
            'status' => PaymentStatus::PENDING,
            'loan_id' => $loan->id,
        ]);

        $result = (new MpesaServices())->stkPush($phone, $amount, $payment->id);

        if (($result['ResponseCode'] ?? 1) != 0) {
            $payment->update(['status' => PaymentStatus::FAILED]);
            throw new \Exception($result['ResponseDescription'] ?? 'STK Push failed');
        }

        if (empty($result['CheckoutRequestID'])) {
            $payment->update(['status' => PaymentStatus::FAILED]);
            throw new \Exception('STK Push did not return CheckoutRequestID');
        }

        MpesaPayment::create([
            'payment_id' => $payment->id,
            'loan_id' => $loan->id,
            'phone' => $phone,
            'checkout_request_id' => $result['CheckoutRequestID'],
            'merchant_request_id' => $result['MerchantRequestID'] ?? null,
            'amount' => $payment->amount,
            'status' => 'pending',
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'STK Push sent. Please complete payment on your phone.',
        ]);

    } catch (\Throwable $e) {
        DB::rollBack();
        Log::error('Mpesa STK Push Error', ['error' => $e->getMessage()]);

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}


public function callback(Request $request)
{
    $callback = $request->input('Body.stkCallback');

    if (!$callback) {
        return response()->json(['ResultCode' => 0]);
    }

    $checkoutId = $callback['CheckoutRequestID'];
    $resultCode = $callback['ResultCode'];

    $mpesaPayment = MpesaPayment::where('checkout_request_id', $checkoutId)->first();

    if (!$mpesaPayment) {
        return response()->json(['ResultCode' => 0]);
    }

    
    if ($mpesaPayment->status === PaymentStatus::SUCCESS) {
        return response()->json(['ResultCode' => 0]);
    }

    DB::transaction(function () use ($mpesaPayment, $callback, $resultCode) {

        $payment = $mpesaPayment->payment;
        $loan = $mpesaPayment->loanApplication;  

        if ($resultCode != 0) {
            $mpesaPayment->update(['status' => PaymentStatus::FAILED]);
            $payment->update(['status' => PaymentStatus::FAILED]);
            return;
        }

       
        $items = collect($callback['CallbackMetadata']['Item']);
        $amount  = (float) $items->firstWhere('Name', 'Amount')['Value'];
        $receipt = $items->firstWhere('Name', 'MpesaReceiptNumber')['Value'];
        $balanceBefore = $loan->balance;
        $loan->total_paid += $amount;
        $loan->balance = max(0,($loan->loan_amount + $loan->total_interest) - $loan->total_paid
);

$interestRemaining = max(0,$loan->total_interest - max(0, $loan->total_paid - $loan->loan_amount)
);

$interestPaid  = min($amount, $interestRemaining);
$principalPaid = $amount - $interestPaid;

if ($loan->balance == 0) {
    $loan->status = 'paid';
}

$loan->save();
 

        $payment->update(['status' => PaymentStatus::SUCCESS]);

        $mpesaPayment->update([
            'status' => PaymentStatus::SUCCESS,
            'mpesa_receipt_number' => $receipt,
            'paid_at' => now(),
            'result_code' => 0,
            'result_desc' => 'Payment successful',
            
        ]);

       
        LoanRepayment::create([
            'loan_application_id' => $loan->id,
            'payment_id' => $payment->id,
            'amount' => $amount,
            'principal' => $principalPaid,
            'interest' => $interestPaid,
            'balance_before' => $balanceBefore,
            'balance_after' => $loan->balance,
            'channel' => PaymentChannel::MPESA,
            'paid_at' => now(),                   
            'late_penalty' => 0,                 
            'status' => 'completed',               
            'payment_method' => 'mpesa',           
            'reference' => $receipt, 
        ]);
    });

    return response()->json(['ResultCode' => 0]);
}





    
public function b2cResult(Request $request)
{
    Log::info('B2C RESULT CALLBACK', $request->all());

    $result = $request->input('Result');
    if (!$result) {
        return response()->json(['message' => 'Invalid result'], 400);
    }

    $conversationID = $result['ConversationID'] ?? null;
    $resultCode = (int) ($result['ResultCode'] ?? 1);

    if (!$conversationID) {
        Log::error('Missing ConversationID in B2C result');
        return response()->json(['message' => 'Invalid result data'], 400);
    }

    $disbursement = LoanDisbursement::where('conversation_id', $conversationID)->first();
    if (!$disbursement) {
        Log::error('Disbursement not found', ['conversationID' => $conversationID]);
        return response()->json(['message' => 'Disbursement not found'], 404);
    }

    $loan = LoanApplication::find($disbursement->loan_application_id);
    if (!$loan) {
        Log::error('Loan not found for disbursement', ['loan_id' => $disbursement->loan_application_id]);
        return response()->json(['message' => 'Loan record missing'], 404);
    }

    DB::transaction(function () use ($disbursement, $loan, $resultCode, $result) {

        if ($resultCode === 0) {
           
            $transactionAmount = 0;
            $transactionReceipt = null;

            $params = $result['ResultParameters']['ResultParameter'] ?? [];
            foreach ($params as $param) {
                if ($param['Key'] === 'TransactionReceipt') $transactionReceipt = $param['Value'];
                if ($param['Key'] === 'TransactionAmount') $transactionAmount = (float) $param['Value'];
            }

            $disbursement->update([
                'status' => 'success',
                'mpesa_receipt_number' => $transactionReceipt,
                'result_code' => 0,
                'result_desc' => 'Success',
                'disbursed_at' => now(),
            ]);

            // Update Loan
            $loan->update([
                'status' => 'disbursed',
                'disbursed_at' => now(),
                
            ]);

        } else {
            // Failed B2C Payment
            $disbursement->update([
                'status' => 'failed',
                'result_code' => $resultCode,
                'result_desc' => $result['ResultDesc'] ?? 'Failed',
            ]);

            Log::warning('B2C Payment failed', ['conversationID' => $disbursement->conversation_id, 'Result' => $result]);
        }
    });

    return response()->json(['message' => 'B2C result processed']);
}


    //   B2C Timeout Callback
    public function b2cTimeout(Request $request)
    {
        Log::info('B2C TIMEOUT CALLBACK', $request->all());

        $result = $request->input('Result');
        if (!$result) {
            return response()->json(['message' => 'Invalid timeout'], 400);
        }

        $conversationID = $result['ConversationID'] ?? null;

        if ($conversationID) {
            $disbursement = LoanDisbursement::where('conversation_id', $conversationID)->first();
            
            if ($disbursement) {
                $disbursement->update([
                    'status' => 'timeout',
                    'result_desc' => 'Request timeout',
                ]);
            }
        }

        return response()->json(['message' => 'B2C timeout processed']);
    }
}
