<?php

namespace App\Models;
use App\Enums\PaymentChannel;
use App\Enums\PaymentStatus;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['user_id', 'amount', 'channel', 'status'];

    protected $casts = [
        'channel' => PaymentChannel::class,
        // 'status' => PaymentStatus::class,
    ];
    

    public function mpesa()
    {
        return $this->hasOne(MpesaPayment::class);
    }

    public function cash()
    {
        return $this->hasOne(CashPayment::class);
    }
}


