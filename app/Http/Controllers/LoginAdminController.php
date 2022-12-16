<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class LoginAdminController extends Controller
{

    public function getRoute() {
        return view('login-admin');
    }

}
