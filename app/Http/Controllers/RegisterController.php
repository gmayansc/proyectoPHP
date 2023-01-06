<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    
    public function getRoute() {
        $done = true;
        return view('register',['done' => $done]);
    }

}
