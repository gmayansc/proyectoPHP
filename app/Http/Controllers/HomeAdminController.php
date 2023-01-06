<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Admin;


class HomeAdminController extends Controller
{
    
    public function getRoute() {

        $admin_id =  Cookie::get('id_admin');

        $admin = Admin::find($admin_id);
        
        if($admin){
            return view('home-admin', ["admin" => $admin]);
        } else {
            return view('login-admin', ["admin" => $admin]);
        }
    }

}
