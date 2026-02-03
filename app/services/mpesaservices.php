<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class MpesaServices
{
    public function stkPush($phone, $amount, $reference)
    {
        try {
            
            $phone = preg_replace('/^0/', '254', $phone);

            // 1️ Get access token
            $tokenResponse = Http::withBasicAuth(
                env('MPESA_CONSUMER_KEY'),
                env('MPESA_CONSUMER_SECRET')
            )->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

            if ($tokenResponse->failed()) {
                throw new \Exception('Failed to get access token from Safaricom');
            }

            $accessToken = $tokenResponse['access_token'];

            // 2 Generate password
            $timestamp = now()->format('YmdHis');
            $password = base64_encode(
                env('LIPA_NA_MPESA_SHORTCODE') .
                env('LIPA_NA_MPESA_PASSKEY') .
                $timestamp
            );

            // 3️ Send STK Push
            $response = Http::withToken($accessToken)->post(
                'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
                [
                    'BusinessShortCode' => env('LIPA_NA_MPESA_SHORTCODE'),
                    'Password' => $password,
                    'Timestamp' => $timestamp,
                    'TransactionType' => 'CustomerPayBillOnline',
                    'Amount' => $amount,
                    'PartyA' => $phone,
                    'PartyB' => env('LIPA_NA_MPESA_SHORTCODE'),
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
    public function b2cPayment($phone, $amount, $remarks = 'Student Loan Disbursement')
{
    try {
        
        $phone = preg_replace('/^0/', '254', $phone);

        // 1️Get access token
        $tokenResponse = Http::withBasicAuth(
            env('MPESA_CONSUMER_KEY'),
            env('MPESA_CONSUMER_SECRET')
        )->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        if ($tokenResponse->failed()) {
            throw new \Exception('Failed to get access token from Safaricom');
        }

        $accessToken = $tokenResponse['access_token'];

        $response = Http::withToken($accessToken)->post(
            'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest',
            [
                'InitiatorName'      => env('MPESA_INITIATOR_USERNAME'),
                'SecurityCredential' => env('MPESA_SECURITY_CREDENTIAL'),
                'CommandID'          => 'BusinessPayment',
                'Amount'             => $amount,
                'PartyA'             => env('LIPA_NA_MPESA_SHORTCODE'),
                'PartyB'             => $phone,
                'Remarks'            => $remarks,
                'QueueTimeOutURL'    => env('MPESA_B2C_TIMEOUT_URL'),
                'ResultURL'          => env('MPESA_B2C_RESULT_URL'),
                'Occasion'           => 'LoanDisbursement',
            ]
        );

        if ($response->failed()) {
            throw new \Exception('B2C request failed');
        }

        return $response->json();

    } catch (\Exception $e) {
        \Log::error('Mpesa B2C Error: ' . $e->getMessage());

        return [
            'ResponseCode' => '1',
            'ResponseDescription' => $e->getMessage(),
        ];
    }
}

}