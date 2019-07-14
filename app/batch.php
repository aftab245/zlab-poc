<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class batch extends Model
{
    function student(){
        return $this->hasMany('App\Student');
    }
}