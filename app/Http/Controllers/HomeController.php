<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Student;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\Classe;
use App\Models\Enrollment;

class HomeController extends Controller
{
    
    public function getRoute() {

        $student_id =  Cookie::get('id');

        $student = Student::find($student_id);

        $schedules = Schedule::all();
        $classes = Classe::all();
        $courses = Course::all();
        $enrollments = Enrollment::all();

        return view('home', ["invalid" => false, "student" => $student, "courses" => $courses, "schedules" => $schedules, "classes" => $classes, "enrollments" => $enrollments]);

    }

    public function getCalendar() {
        return view('calendar');
    }

}
