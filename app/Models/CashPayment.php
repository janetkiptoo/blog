<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashPayment extends Model
{
    protected $fillable = [
        'payment_id',
        'receipt_number',
        'received_by',
        'received_at',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
