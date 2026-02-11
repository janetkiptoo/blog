<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashPayment extends Model
{
    protected $fillable = [
        'payment_id',
        'loan_application_id',
        'user_id',
        'amount',
        'status',
        'processed_by',
        'processed_at',
        'receipt_number',
        
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function loanApplication()
    {
        return $this->belongsTo(LoanApplication::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}

