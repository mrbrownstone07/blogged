<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class follows extends Model
{
    protected $fillable = [
        'followee', 'follower', 
    ];
}
