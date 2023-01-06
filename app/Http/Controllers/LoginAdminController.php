<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class LoginAdminController extends Controller
{

    public function getRoute() {
        $done = true;
        return view('login-admin', ['done' => $done]);
    }

}
