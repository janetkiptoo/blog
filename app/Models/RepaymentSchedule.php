<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepaymentSchedule extends Model
{
    protected $table = 'repayment_schedules';
    protected $fillable = [
        'loan_application_id',
        'month_number',
        'due_date',
        'principal_amount',
        'interest_amount',
        'total_payment',
        'is_paid',
        'paid_at',
    ];
    //
}
