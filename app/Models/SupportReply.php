<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportReply extends Model
{
    protected $fillable = [
        'support_ticket_id',
        'message',
        'is_admin',
    ];

    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class);
    }
}
