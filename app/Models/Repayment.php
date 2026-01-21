<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model

{
     protected $table = 'loan_repayments';
    protected $fillable = [
        'loan_application_id',
        'amount',
        'status',
        'paid_at',
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

