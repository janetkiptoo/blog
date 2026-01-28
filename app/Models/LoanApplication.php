<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{

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
        'approved_amount',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanProduct()
    {
         return $this->belongsTo(LoanProduct::class, 'loan_product_id');
    }
    // app/Models/LoanApplication.php

 public function repayments()
    {
        return $this->hasMany(LoanRepayment::class);
    }
    
    public function guarantors()
{
    return $this->hasMany(Guarantor::class);
}
    


    //
}
