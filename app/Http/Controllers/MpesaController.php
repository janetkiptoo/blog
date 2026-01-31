<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Services\MpesaServices;

class MpesaController extends Controller
{
    protected MpesaServices $mpesa;

    public function __construct(MpesaServices $mpesa)
    {
        $this->mpesa = $mpesa;
    }

    // 1️⃣ Initiate STK Push
    public function STKPush(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'phonenumber' => 'required|string',
            'account_number' => 'required|string',
        ]);

        $amount = (int) round($request->amount);
        $phone = $request->phonenumber;
        $account_number = $request->account_number;

        $result = $this->mpesa->stkPush($phone, $amount, $account_number);

        // Save payment as pending
      Payment::create([
    'user_id' => auth()->id() ?? null,
    'payment_method_id' => 1, // e.g., Mpesa method ID
    'merchant_request_id' => $result['MerchantRequestID'] ?? null,
    'checkout_request_id' => $result['CheckoutRequestID'] ?? null,
    'amount' => $amount,
    'phone' => preg_replace('/^0/', '254', $phone),
    'status' => 'pending',
        'ref_id' => $account_number,
]);

        return response()->json($result);
    }

    // 2️⃣ Handle Safaricom Callback
    public function callback(Request $request)
    {
        $data = $request->all();

        $callbackData = $data['Body']['stkCallback'] ?? null;

        if (!$callbackData) {
            return response()->json(['message' => 'Invalid callback'], 400);
        }

        $checkoutRequestID = $callbackData['CheckoutRequestID'] ?? null;
        $resultCode = $callbackData['ResultCode'] ?? null;

        $payment = Payment::where('checkout_request_id', $checkoutRequestID)->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        if ($resultCode == 0) {
            // Payment successful
            $payment->status = 'success';

            $callbackMetadata = $callbackData['CallbackMetadata']['Item'] ?? [];
            foreach ($callbackMetadata as $item) {
                if ($item['Name'] === 'MpesaReceiptNumber') {
                    $payment->receipt_number = $item['Value'];
                } elseif ($item['Name'] === 'Amount') {
                    $payment->amount = $item['Value'];
                }
            }
        } else {
            // Payment failed or cancelled
            $payment->status = 'failed';
        }

        $payment->save();

        return response()->json(['message' => 'Callback processed successfully']);
    }
}
