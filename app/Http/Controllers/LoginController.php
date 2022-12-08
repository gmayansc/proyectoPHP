<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class LoginController extends Controller
{

    public function index() {
        $test = "HOLITA";
        return view('index', ["test" => $test]);
    }

    public function test(){
        echo "asdasd";
    }

}
