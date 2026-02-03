<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepaymentSchedule extends Model
{
    protected $table = 'repayment_schedules';
    protected $fillable = [
        'loan_application_id',
        'amount_due',
        'due_date',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'paid_at' => 'datetime',
    ];
    public function loan()
    {
        return $this->belongsTo(LoanApplication::class, 'loan_application_id');
    }
    //
}
