<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanDisbursement extends Model
{
    protected $table = 'loan_disbursements';
    protected $fillable = [
        'loan_application_id',
        'user_id',
        'conversation_id',
        'originator_conversation_id',
        'result_code',
        'result_desc',
        'status',
        'amount',
        'phone_number',
        'transaction_id',
        'result_type',
        'disbursed_at',
        
    ];

    protected $casts = [
        'disbursed_at' => 'datetime',
    ];
    //
    public function loanApplication()
    {
        return $this->belongsTo(LoanApplication::class, 'loan_application_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
