<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    function home(){
        return view('Users.User_home');
    }
}
