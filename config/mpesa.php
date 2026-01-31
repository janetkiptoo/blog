<?php

return [
      'environment' => env('MPESA_ENVIRONMENT', 'sandbox'),
    /*
    |--------------------------------------------------------------------------
    | Consumer Key
    |--------------------------------------------------------------------------
    |
    | Consumer Key of the App from developer.safaricom.co.ke
    |
    */
    'consumerKey' => env('MPESA_CONSUMER_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Consumer Secret
    |--------------------------------------------------------------------------
    |
    | Consumer Secret of the App from developer.safaricom.co.ke
    |
    */
    'consumerSecret' => env('MPESA_CONSUMER_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Callback URL
    |--------------------------------------------------------------------------
    |
    | A CallBack URL is a valid secure URL that is used to receive notifications
    | from M-Pesa API. It is the endpoint to which the results will be sent by
    | M-Pesa API.
    |
    */
    'callBackURL' => env('MPESA_CALLBACK_URL'),

    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | Base URL for Mpesa API Calls
    |
    */
    'baseUrl' => env('MPESA_BASE_URL', 'https://sandbox.safaricom.co.ke'),

    /*
    |--------------------------------------------------------------------------
    | Paybill Number
    |--------------------------------------------------------------------------
    |
    | Your M-Pesa Paybill Number
    |
    */
    'paybillNumber' => env('MPESA_PAYBILL_NUMBER'),

    /*
    |--------------------------------------------------------------------------
    | Lipa na Mpesa Shortcode
    |--------------------------------------------------------------------------
    |
    | Lipa na Mpesa Shortcode (Paybill or Till Number)
    |
    */
    'lipaNaMpesaShortcode' => env('LIPA_NA_MPESA_SHORTCODE'),

    /*
    |--------------------------------------------------------------------------
    | Lipa na Mpesa Callback URL
    |--------------------------------------------------------------------------
    |
    | Callback URL for Lipa na Mpesa transactions
    |
    */
    'lipaNaMpesaCallbackURL' => env('LIPA_NA_MPESA_CALLBACK_URL'),

    /*
    |--------------------------------------------------------------------------
    | Lipa na Mpesa Passkey
    |--------------------------------------------------------------------------
    |
    | Passkey for Lipa na Mpesa transactions
    |
    */
    'lipaNaMpesaPasskey' => env('LIPA_NA_MPESA_PASSKEY'),

    /*
    |--------------------------------------------------------------------------
    | C2B Confirmation URL
    |--------------------------------------------------------------------------
    |
    | URL for C2B transaction confirmations
    |
    */
    'confirmationURL' => env('MPESA_CONFIRMATION_URL'),

    /*
    |--------------------------------------------------------------------------
    | C2B Validation URL
    |--------------------------------------------------------------------------
    |
    | URL for C2B transaction validations
    |
    */
    'validationURL' => env('MPESA_VALIDATION_URL'),

    /*
    |--------------------------------------------------------------------------
    | Mpesa Initiator Username
    |--------------------------------------------------------------------------
    |
    | Username for initiating M-Pesa transactions
    |
    */
    'initiatorUsername' => env('MPESA_INITIATOR_USERNAME'),

    /*
    |--------------------------------------------------------------------------
    | Mpesa Initiator Password
    |--------------------------------------------------------------------------
    |
    | Password for initiating M-Pesa transactions
    |
    */
    'initiatorPassword' => env('MPESA_INITIATOR_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    |
    | M-Pesa API environment (sandbox or production)
    |
    */
    'environment' => env('MPESA_ENVIRONMENT', 'sandbox'),

    /*
    |--------------------------------------------------------------------------
    | Queue Timeout URL
    |--------------------------------------------------------------------------
    |
    | URL for queue timeout notifications
    |
    */
    'queueTimeOutURL' => env('MPESA_QUEUE_TIMEOUT_URL'),

    /*
    |--------------------------------------------------------------------------
    | Result URL
    |--------------------------------------------------------------------------
    |
    | URL for transaction results
    |
    */
    'resultURL' => env('MPESA_RESULT_URL'),
    'callbacks' => [
            'c2b_validation_url' => env('MPESA_C2B_VALIDATION_URL'),
            'c2b_confirmation_url' => env('MPESA_C2B_CONFIRMATION_URL'),
            'b2c_result_url' => env('MPESA_B2C_RESULT_URL'),
            'b2c_timeout_url' => env('MPESA_B2C_TIMEOUT_URL'),
            'callback_url' => env('MPESA_CALLBACK_URL'),
            'status_result_url' => env('MPESA_STATUS_RESULT_URL'),
            'status_timeout_url' => env('MPESA_STATUS_TIMEOUT_URL'),
            'balance_result_url' => env('MPESA_BALANCE_RESULT_URL'),
            'balance_timeout_url' => env('MPESA_BALANCE_TIMEOUT_URL'),
            'reversal_result_url' => env('MPESA_REVERSAL_RESULT_URL'),
            'reversal_timeout_url' => env('MPESA_REVERSAL_TIMEOUT_URL'),
            'b2b_result_url' => env('MPESA_B2B_RESULT_URL'),
            'b2b_timeout_url' => env('MPESA_B2B_TIMEOUT_URL'),
        ],
    ];


