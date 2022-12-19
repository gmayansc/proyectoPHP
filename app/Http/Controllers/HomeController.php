<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Student;




class HomeController extends Controller
{
    
    public function getRoute() {

        $student_id =  Cookie::get('id');

        $student = Student::find($student_id);
        return view('home', ["student" => $student]);

    }

    public function getCalendar() {
        return view('calendar');
    }

}
