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

        if($student){
            return view('home', ["invalid" => false, "student" => $student, "courses" => $courses, "schedules" => $schedules, "classes" => $classes, "enrollments" => $enrollments]);
        } else {
            return view('index',["invalid" => false]);
        }


    }

    public function getCalendar() {
        return view('calendar');
    }


    public function modifyProfile(){
        $student_id =  Cookie::get('id');

        $student = Student::find($student_id);

        return view('modify-profile', [ "student" => $student]);
    }


    public function updateProfile(Request $request){

            $student_id = $request->input('student_id');
            
            $student = Student::find($student_id);
            $not = "false";
            
            $notificaciones = $request->input('notifications');
            if($notificaciones == "on"){
                $not = "true";
            }

            // Cambia el estado del usuario dependiendo del valor que ingresa
            $student->name =  $request->input('name');
            $student->surname =  $request->input('surname');
            $student->username =  $request->input('username');
            $student->pass =  $request->input('password');
            $student->nif =  $request->input('nif');
            $student->telephone =  $request->input('telephone');
            $student->notifications = $not;
            // Guarda la fila
            $student->save();
            return redirect('/home');

    }

}
