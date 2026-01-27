<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guarantor extends Model
{
    protected $fillable = [
        'loan_application_id',
        'name',
        'relationship',
        'national_id',
        'phone',
        'email',
        'consent_given',
        'employment_status',
        'physical_address'
    ];

    public function loan()
    {
        return $this->belongsTo(LoanApplication::class);
    }
}
