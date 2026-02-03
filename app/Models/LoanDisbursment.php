<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanDisbursment extends Model
{
    protected $table = 'loan_disbursements';
    protected $fillable = [
        'loan_application_id',
        'user_id',
        'amount',
        'phone_number',
        'mpesa_transaction_id',
        'status',
        
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
