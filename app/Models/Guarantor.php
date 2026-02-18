<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guarantor extends Model
{
    protected $fillable = [
        
        'name',
        'user_id',
        'relationship',
        'national_id',
        'phone',
        'email',
        'consent_given',
        'employment_status',
        'physical_address',
        'image',
        'income_range',
        'id_type',
        'status',
        'admin_notes',
        'rejection_reason',
        'reviewed_at',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

public function activeGuarantors()
{
    return $this->hasMany(Guarantor::class)
        ->whereIn('status', ['pending', 'approved']);
}


    
}
