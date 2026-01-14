<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{

protected $table = 'loan_application';                                                                              
    protected $fillable = [
        'user_id',
        'loan_product_id',
        'loan_amount',
        'status',
        'approved_amount',
    ];
    //
}
