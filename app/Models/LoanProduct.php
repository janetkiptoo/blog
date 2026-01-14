<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanProduct extends Model
{
    protected $fillable = [
        'product_name',
        'description',
        'interest_rate',
        'loan_term_months',
        'max_loan_amount',
        'min_loan_amount',
    ];
    //
}


