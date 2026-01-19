<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRepayment extends Model
{
    protected $table = 'loan_repayments';
     protected $fillable = [
        'loan_application_id',
        'amount',
        'paid_at'
    ];

    public function loan()
    {
        return $this->belongsTo(LoanApplication::class, 'loan_application_id');
    }
}

    //

