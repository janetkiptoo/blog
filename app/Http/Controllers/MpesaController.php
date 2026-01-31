<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\MpesaPayment;
use App\Services\MpesaServices;
use App\Enums\PaymentChannel; //
use App\Enums\PaymentStatus; //
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    protected MpesaServices $mpesa;

    public function __construct(MpesaServices $mpesa)
    {
        $this->mpesa = $mpesa;
    }

    //
    public function stkPush(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'phonenumber' => 'required|string',
            'account_number' => 'required|string',
        ]);

        $amount = (int) round($request->amount); // integer required by Mpesa
        $phone = $request->phonenumber;
        $account_number = $request->account_number;

        // Send STK push
        $result = $this->mpesa->stkPush($phone, $amount, $account_number);

        // Save payment as pending
      Payment::create([
        'user_id' => auth()->id() ?? null,
        'payment_method_id' => 1, // Mpesa
        'merchant_request_id' => $result['MerchantRequestID'] ?? null,
        'checkout_request_id' => $result['CheckoutRequestID'] ?? null,
        'amount' => $amount,
        'phone' => preg_replace('/^0/', '254', $phone),
        'status' => PaymentStatus::PENDING, // Enum instance
        'channel' => PaymentChannel::MPESA, // Enum instance
        'ref_id' => $account_number,
]);


        return response()->json($result);
    }


    // Safaricom callback for STK Push
    public function callback(Request $request)
{
     Log::info('MPESA CALLBACK HIT', $request->all());
    $callback = $request->input('Body.stkCallback');

    if (!$callback) {
        return response()->json(['message' => 'Invalid callback'], 400);
    }

    $checkoutRequestID = $callback['CheckoutRequestID'];
    $resultCode        = $callback['ResultCode'];
    $resultDesc        = $callback['ResultDesc'] ?? null;

    $payment = Payment::where('checkout_request_id', $checkoutRequestID)->first();

    if (!$payment) {
        return response()->json(['message' => 'Payment not found'], 404);
    }

    if ($resultCode == 0) {
        $payment->status = PaymentStatus::SUCCESS;

        $metadata = collect($callback['CallbackMetadata']['Item'] ?? []);

        $receipt = $metadata->firstWhere('Name', 'MpesaReceiptNumber')['Value'] ?? null;
        $amount  = $metadata->firstWhere('Name', 'Amount')['Value'] ?? null;

        // ✅ WRITE TO mpesa_payments
        MpesaPayment::updateOrCreate(
            ['checkout_request_id' => $checkoutRequestID],
            [
                'payment_id'           => $payment->id,
                'phone'                => $payment->phone,
                'merchant_request_id'  => $callback['MerchantRequestID'] ?? null,
                'mpesa_receipt_number' => $receipt,
                'result_code'          => $resultCode,
                'result_desc'          => $resultDesc,
                'paid_at'              => now(),
            ]
        );

        if ($amount) {
            $payment->amount = $amount;
        }
    } else {
        $payment->status = PaymentStatus::FAILED;
    }

    $payment->save();

    return response()->json(['message' => 'Callback processed']);
}
}


