<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LoanApplication extends Model
{

  public const STATUS_SUBMITTED    = 'submitted';
    public const STATUS_UNDER_REVIEW = 'under_review';
    public const STATUS_APPROVED     = 'approved';
    public const STATUS_REJECTED     = 'rejected';
    public const STATUS_DISBURSED    = 'disbursed';
    public const STATUS_CLOSED       = 'closed';
    protected $fillable = [
        'user_id',
        'loan_product_id',
        'loan_amount',
        'term_months',
        'interest_rate',
        'monthly_payment',
        'total_interest',
        'approved_amount',
        'balance',
        'total_paid',
        'status',
        'submitted_at',
        'approved_at',
        'disbursed_at',
        'rejection_reason',
        'disbursement_method',
        'disbursement_phone',
        'bank_name',
        'bank_account_number',
        
        
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanProduct()
    {
         return $this->belongsTo(LoanProduct::class, 'loan_product_id');
    }

    public function repayments()
    {
        return $this->hasMany(LoanRepayment::class);
    }
    
    public function guarantors()
{
    return $this->hasMany(Guarantor::class);
}

    public function repaymentSchedules()
{
    return $this->hasMany(RepaymentSchedule::class);
}

   public function disbursement()
    {
        return $this->hasOne(LoanDisbursement::class);
    }

public function payments()
{
    return $this->hasMany(Payment::class);
}  
 
public function cashPayments()
    {
      return $this->hasMany(CashPayment::class);
    }

    

}
