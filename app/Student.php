<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    function bat(){
        return $this->belongsTo('App\batch');
    }
}