<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class HomeAdminController extends Controller
{
    
    public function getRoute() {
        return view('home-admin');
    }

}
