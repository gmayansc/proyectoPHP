<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class RegisterAdminController extends Controller
{
    
    public function getRoute() {
        return view('register-admin');
    }

}
