<?php

namespace App\Models;

use App\Enums\PaymentChannel;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;

class LoanRepayment extends Model
{
    protected $table = 'loan_repayments';

    protected $fillable = [
        'loan_application_id',
        'amount',
        'interest',
        'principal',
        'balance_before',
        'balance_after',
        'payment_method',
        'reference',
        'payment_id',
        'paid_at',
        'late_penalty',
        'channel',
        'status',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'channel' => PaymentChannel::class,
        'status'  => 'string', // keep string OR convert to enum later
    ];

    public function loan()
    {
        return $this->belongsTo(LoanApplication::class, 'loan_application_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    

    public function getChannelNameAttribute(): string
    {
        if ($this->channel instanceof PaymentChannel) {
            return match ($this->channel) {
                PaymentChannel::MPESA => 'Mpesa',
                PaymentChannel::CASH  => 'Cash',
            };
        }

        return ucfirst($this->channel ?? 'N/A');
    }

    public function getStatusNameAttribute(): string
    {
        return match ($this->status) {
            'completed', 'success' => 'Completed',
            'pending'              => 'Pending',
            'failed', 'rejected'   => 'Failed',
            default                => 'N/A',
        };
    }

    public function getMpesaReceiptAttribute(): string
    {
        return $this->channel === PaymentChannel::CASH
            ? '-'
            : ($this->reference ?? '-');
    }
}
