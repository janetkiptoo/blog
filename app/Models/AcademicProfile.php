<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicProfile extends Model
{
    protected $fillable = [
        'user_id',
        'institution_name',
        'institution_type',
        'course_name',
        'level',
        'student_document',
        'student_registration_number',
        'status',
        'rejection_reason',
        'reviewed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

