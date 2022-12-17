<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    
    public function getRoute() {
        $invalid = false;
        return view('index', ['invalid' => $invalid]);
    }

}
