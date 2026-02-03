<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\MpesaPayment;
use App\Services\MpesaServices;
use App\Models\LoanApplication;
use App\Models\LoanRepayment;
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

        $amount = (int) round($request->amount);
        $phone = preg_replace('/^0/', '254', $request->phonenumber);
        $loanId = $request->account_number;

        $loan = LoanApplication::where('id', $loanId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        DB::beginTransaction();

        try {
            $payment = Payment::create([
                'user_id' => auth()->id(),
                'amount' => $amount,
                'channel' => PaymentChannel::MPESA,
                'status' => PaymentStatus::PENDING,
            ]);

            $result = $this->mpesa->stkPush($phone, $amount, $payment->id);

            if (($result['ResponseCode'] ?? 1) != 0) {
                throw new \Exception($result['ResponseDescription'] ?? 'STK Push failed');
            }

            MpesaPayment::create([
                'payment_id' => $payment->id,
                'loan_id' => $loan->id,
                'phone' => $phone,
                'checkout_request_id' => $result['CheckoutRequestID'] ?? null,
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
        Log::info('MPESA CALLBACK HIT', $request->all());

        $callback = $request->input('Body.stkCallback');
        if (!$callback) {
            return response()->json(['message' => 'Invalid callback'], 400);
        }

        $checkoutRequestID = $callback['CheckoutRequestID'] ?? null;
        $resultCode = (int) ($callback['ResultCode'] ?? 1);
        $items = $callback['CallbackMetadata']['Item'] ?? [];

        if (!$checkoutRequestID) {
            Log::error('Missing CheckoutRequestID in callback');
            return response()->json(['message' => 'Invalid callback data'], 400);
        }

        $mpesaPayment = MpesaPayment::where('checkout_request_id', $checkoutRequestID)->first();
        if (!$mpesaPayment) {
            Log::error('MpesaPayment not found', ['checkoutRequestID' => $checkoutRequestID]);
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment = Payment::find($mpesaPayment->payment_id);
        $loan = LoanApplication::find($mpesaPayment->loan_id);

        DB::transaction(function () use ($mpesaPayment, $payment, $loan, $resultCode, $items, $callback) {

            if ($resultCode === 0) {
                $amount = 0;
                $receipt = null;

                foreach ($items as $item) {
                    if ($item['Name'] === 'Amount') {
                        $amount = (float) $item['Value'];
                    }
                    if ($item['Name'] === 'MpesaReceiptNumber') {
                        $receipt = $item['Value'];
                    }
                }

                $mpesaPayment->update([
                    'mpesa_receipt_number' => $receipt,
                    'result_code' => 0,
                    'result_desc' => 'Success',
                    'paid_at' => now(),
                ]);

                $payment->update(['status' => 'success']);

                $balanceBefore = $loan->balance;
                $loan->balance -= $amount;
                $loan->total_paid += $amount;

                if ($loan->balance <= 0) {
                    $loan->balance = 0;
                    $loan->status = 'completed';
                }

                $loan->save();

                LoanRepayment::create([
                    'loan_application_id' => $loan->id,
                    'payment_id' => $payment->id,
                    'amount' => $amount,
                    'principal' => $amount,
                    'interest' => 0,
                    'balance_before' => $balanceBefore,
                    'balance_after' => $loan->balance,
                    'paid_at' => now(),
                    'late_penalty' => 0,
                    'channel' => PaymentChannel::MPESA,

                ]);

            } else {
                $mpesaPayment->update([
                    'result_code' => $resultCode,
                    'result_desc' => $callback['ResultDesc'] ?? 'Cancelled',
                    'paid_at' => now(),
                ]);

                $payment->update(['status' => 'failed']);
            }
        });

        return response()->json(['message' => 'Callback processed']);
    }
}
