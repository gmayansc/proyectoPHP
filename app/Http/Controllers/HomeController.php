<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Student;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\Classe;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Work;

class HomeController extends Controller
{
    
    public function getRoute() {

        $student_id =  Cookie::get('id');

        $student = Student::find($student_id);

        $exams = Exam::where('id_student', $student_id)->get();

        $works = Work::where('id_student', $student_id)->get();

        $schedules = Schedule::all();
        
        
        $courses = Course::all();



        // $enrollments = Enrollment::where('id_student', $student_id)->get();
     $enrollments = Enrollment::join('courses', 'enrollment.id_course', '=', 'courses.id_course')
        ->join('classes', 'enrollment.id_course', '=', 'classes.id_course')
        ->join('teachers', 'classes.id_teacher', '=', 'teachers.id_teacher')
        ->join('schedules', 'classes.id_schedule', '=', 'schedules.id_schedule')
        ->join('students', 'enrollment.id_student', '=', 'students.id_student')
        ->select('schedules.time_start', 'teachers.name as Profesor', 'schedules.day as Dia', 'courses.name as Curso', 'students.name as Alumno', 'classes.name as Asignatura')
        ->where('enrollment.id_student', $student_id)
        ->get();


    

        if($student){
            return view('home', ["invalid" => false, "exams"=>$exams,"works"=>$works , "student" => $student, "courses" => $courses, "schedules" => $schedules, "enrollments" => $enrollments, "enrollments" => $enrollments]);
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

    public function enrollment(Request $request){

            $id_student = $request->input('id_student');
            $id_course = $request->input('id_course');

            Enrollment::create([
                'id_student' => $id_student,
                'id_course' => $id_course,
                'status' => "0",
            ]);

            return redirect('/home');


    }

}
