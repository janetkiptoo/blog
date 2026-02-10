<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MpesaPayment extends Model
{
    protected $fillable = [
        'payment_id',
        'phone',
        'loan_id',
        'amount',
        'checkout_request_id',
        'merchant_request_id',
        'mpesa_receipt_number',
        'result_code',
        'result_desc',
        'paid_at',
       

        
    ];
        protected $dates = ['paid_at'];
        


    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}

