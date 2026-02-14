<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = [
        'name',
        'email',
        'category',
        'message',
        'status',
    ];
    //

    public function replies()
{
    return $this->hasMany(SupportReply::class);
}

}
