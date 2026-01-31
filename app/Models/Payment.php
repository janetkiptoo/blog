<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'loan_id',
        'phone',
        'payment_method_id',
        'amount',
        'ref_id',
        'external_ref',
        'status',
        'paid_at'
    ];

    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}

