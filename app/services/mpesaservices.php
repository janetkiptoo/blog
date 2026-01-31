<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class MpesaServices
{
    public function stkPush($phone, $amount, $reference)
    {
        try {
            // Format phone to 2547XXXXXXXX
            $phone = preg_replace('/^0/', '254', $phone);

            // 1️⃣ Get access token
            $tokenResponse = Http::withBasicAuth(
                env('MPESA_CONSUMER_KEY'),
                env('MPESA_CONSUMER_SECRET')
            )->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

            if ($tokenResponse->failed()) {
                throw new \Exception('Failed to get access token from Safaricom');
            }

            $accessToken = $tokenResponse['access_token'];

            // 2️⃣ Generate password
            $timestamp = now()->format('YmdHis');
            $password = base64_encode(
                env('MPESA_SHORTCODE') .
                env('MPESA_PASSKEY') .
                $timestamp
            );

            // 3️⃣ Send STK Push
            $response = Http::withToken($accessToken)->post(
                'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
                [
                    'BusinessShortCode' => env('MPESA_SHORTCODE'),
                    'Password' => $password,
                    'Timestamp' => $timestamp,
                    'TransactionType' => 'CustomerPayBillOnline',
                    'Amount' => $amount,
                    'PartyA' => $phone,
                    'PartyB' => env('MPESA_SHORTCODE'),
                    'PhoneNumber' => $phone,
                    'CallBackURL' => env('MPESA_CALLBACK_URL'),
                    'AccountReference' => $reference,
                    'TransactionDesc' => 'Payment',
                ]
            );

            if ($response->failed()) {
                throw new \Exception('STK Push request failed');
            }

            return $response->json();

        } catch (\Exception $e) {
            \Log::error('Mpesa STK Push Error: ' . $e->getMessage());

            return [
                'ResponseCode' => '1',
                'ResponseDescription' => $e->getMessage(),
            ];
        }
    }
}