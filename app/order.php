<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'user_id', 'user_name', 'user_phone', 'status', 'p_name', 'p_qty',
        'p_model','p_desc',

    ];
}
