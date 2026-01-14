<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'full_name',
        'national_id',
        'email',
        'phone',
        'institution',
        'course',
        'year_of_study',
        'student_reg_no',
        'loan_amount',
        'loan_purpose',
    ];
    //
}
