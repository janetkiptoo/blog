<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LoanApplication extends Model
{
    const STATUS_PENDING   = 'pending';
    const STATUS_APPROVED  = 'approved';
    const STATUS_REJECTED  = 'rejected';
    const STATUS_DISBURSED = 'disbursed';
    const STATUS_PAID      = 'paid';
protected $table = 'loan_application';                                                                              
    protected $fillable = [
        'name',
        'email',
        'phone',
        'national_id',
        'institution',
        'course',
        'year_of_study',
        'student_reg_no',
        'user_id',
        'loan_product_id',
        'loan_amount',
        'status',
        'term_months',
        'interest_rate',
        'balance',
        'monthly_payment',
        'total_paid',
        'total_interest',
        'approved_amount',
        'disbursed_at',
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
