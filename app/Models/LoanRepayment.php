<?php

namespace App\Models;
use App\Enums\PaymentChannel;

use Illuminate\Database\Eloquent\Model;


class LoanRepayment extends Model
{
    protected $table = 'loan_repayments';
     protected $fillable = [
        'loan_application_id',
        'amount',
        'interest',
        'principal',
        'balance_before',
        'balance_after',
        'payment_method',
        'reference',
        'payment_id',
        'paid_at',
        'late_penalty',
        'channel',
        
    ];
     protected $casts = [
        'paid_at' => 'datetime',
        'channel' => PaymentChannel::class,

    ];

    public function loan()
    {
        return $this->belongsTo(LoanApplication::class, 'loan_application_id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}

    //

