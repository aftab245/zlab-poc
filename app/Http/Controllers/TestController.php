<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\batch;
use App\student;

class TestController extends Controller
{
    public function index(){
       
        return batch::find(1)->student;
        
    }


    public function index1(){
       
        return student::find(1)->bat;
        
    }
   
}