<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
     protected $fillable = [
        'name',
        'code',
        'requires_reference',
        'is_active'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    //
}
