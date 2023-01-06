<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class RegisterAdminController extends Controller
{
    
    public function getRoute() {
        $done = true;
        return view('register-admin',['done' => $done]);
    }

}
