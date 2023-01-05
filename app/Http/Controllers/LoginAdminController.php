<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class LoginAdminController extends Controller
{

    public function getRoute() {
        $invalid = false;
        return view('login-admin', ['invalid' => $invalid]);
    }

}
