<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterItem extends Model
{
    protected $fillable = [
        'section',
        'label',
        'value',
        'url',
        'icon',
        'sort_order',
        'is_active',
    ];
    
}
