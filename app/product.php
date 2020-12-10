<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'user_id', 'name', 'category', 'c_model', 'price', 'description',
        'image1', 'image2', 'image3', 'image4', 'image5',

    ];
}
