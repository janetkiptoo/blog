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
        'grace_period_months',
    ];
   


public function loanApplications()
{
    return $this->hasMany(LoanApplication::class);
}

public function hasActiveLoanForUser(int $userId): bool
{
    return $this->loanApplications()
        ->where('user_id', $userId)
        ->whereIn('status', [
            LoanApplication::STATUS_SUBMITTED,
            LoanApplication::STATUS_UNDER_REVIEW,
            LoanApplication::STATUS_APPROVED,
            LoanApplication::STATUS_DISBURSED,
        ])
        ->exists();
}

    //
}


