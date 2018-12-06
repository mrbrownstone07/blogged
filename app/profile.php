<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $fillable = [
        'city', 'country', 'fname', 'lname', 'about', 'bio',
        'user_id',
    ];

}
