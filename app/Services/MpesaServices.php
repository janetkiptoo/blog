<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class MpesaServices
{
    /**
     * Get M-Pesa Access Token
     */
    private function getAccessToken()
    {
        $response = Http::withBasicAuth(
            env('MPESA_CONSUMER_KEY'),
            env('MPESA_CONSUMER_SECRET')
        )->get(env('MPESA_BASE_URL').'/oauth/v1/generate?grant_type=client_credentials');

        if ($response->failed()) {
            throw new \Exception('Failed to get access token from Safaricom');
        }

        return $response['access_token'];
    }

   private function getSecurityCredential()
{
    if (env('MPESA_ENVIRONMENT') === 'sandbox') {
        $certPath = storage_path('certificates/safaricom_sandbox.cer');
    } else {
        $certPath = storage_path('certificates/safaricom_production.cer');
    }
    
    if (!file_exists($certPath)) {
        \Log::error('Certificate not found', ['path' => $certPath]);
        throw new \Exception("Certificate file not found at: $certPath");
    }

    $certContent = file_get_contents($certPath);
    $publicKey = openssl_pkey_get_public($certContent);
    
    if (!$publicKey) {
        \Log::error('Failed to load public key from certificate');
        throw new \Exception('Invalid certificate file');
    }

    $plaintext = env('MPESA_B2C_INITIATOR_PASSWORD');
    $encrypted = '';
    
    openssl_public_encrypt($plaintext, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);
    
    return base64_encode($encrypted);
}
    /**
     * STK Push for Customer Payments
     */
    public function stkPush($phone, $amount, $reference)
    {
        try {   
            $accessToken = $this->getAccessToken();

            // Generate password
            $timestamp = now()->format('YmdHis');
            $password = base64_encode(
                env('LIPA_NA_MPESA_SHORTCODE').
                env('LIPA_NA_MPESA_PASSKEY').
                $timestamp
            );

            // Send STK Push
            $response = Http::withToken($accessToken)->post(
                env('MPESA_BASE_URL').'/mpesa/stkpush/v1/processrequest',
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
                    'TransactionDesc' => 'Loan Repayment',
                ]
            );

            if ($response->failed()) {
                throw new \Exception('STK Push request failed');
            }

            return $response->json();

        } catch (\Exception $e) {
            Log::error('Mpesa STK Push Error: '.$e->getMessage());

            return [
                'ResponseCode' => '1',
                'ResponseDescription' => $e->getMessage(),
            ];
        }
    }

    /**
     * B2C Payment For Loan Disbursement
     */
    public function b2c($phone, $amount, $reference)
    {
        try {
            $accessToken = $this->getAccessToken();
            $securityCredential = $this->getSecurityCredential(); 
            $securityCredential = env('MPESA_SECURITY_CREDENTIAL'); // This will now return base64 encoded

            $payload = [
                'InitiatorName' => env('MPESA_B2C_INITIATOR_NAME'),
                'SecurityCredential' => $securityCredential,  // Use the base64 encoded version
                'CommandID' => 'BusinessPayment',
                'Amount' => $amount,
                'PartyA' => env('MPESA_B2C_SHORTCODE'),
                'PartyB' => $phone,
                'Remarks' => 'Loan Disbursement',
                'QueueTimeOutURL' => env('MPESA_B2C_QUEUE_TIMEOUT_URL'),
                'ResultURL' => env('MPESA_B2C_RESULT_URL'),
                'Occasion' => 'Loan Disbursement - '.$reference,
            ];


            Log::info('B2C Request Payload', $payload);

            $response = Http::withToken($accessToken)->post(
                env('MPESA_BASE_URL').'/mpesa/b2c/v1/paymentrequest',
                $payload
            );

            Log::info('B2C Response', $response->json());

            if ($response->failed()) {
                Log::error('B2C Request Failed', $response->json());
                throw new \Exception('B2C request failed');
            }

            return $response->json();

        } catch (\Exception $e) {
            Log::error('Mpesa B2C Error: '.$e->getMessage());

            return [
                'ResponseCode' => '1',
                'ResponseDescription' => $e->getMessage(),
            ];
        }
    }
}
