<?php

namespace App\Models;

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
        
    ];
     protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function loan()
    {
        return $this->belongsTo(LoanApplication::class, 'loan_application_id');
    }
}

    //

