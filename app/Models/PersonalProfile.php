<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalProfile extends Model
{
    protected $fillable = [
        'user_id',
        'gender',
        'nationality',
        'government_id_type',
        'government_id_number',
        'address',
        'date_of_birth',
        'id_image',
        'status',
        'rejection_reason',
        'reviewed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

