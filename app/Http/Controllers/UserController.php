<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function show($name ='moath'){
        return "hollw ".$name;
    }
}
