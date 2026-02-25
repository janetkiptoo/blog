<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EligibilityRequirement extends Model
{

 protected $fillable = [
        'country',
        'institution',
        'institution_type',
        'course_type',
        'loan_purpose',
        'min_age',
        'max_age',
        'is_active',
    ];
    //
}
