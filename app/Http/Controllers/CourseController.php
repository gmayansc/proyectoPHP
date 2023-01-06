<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getRoute()
    {
        $courses = Course::all();


        return view('courses', ['courses' => $courses]);
    }

    public function getUpdateCourseRoute(Request $request)
    {
        $id_course = $request->get('id');
        $course = Course::find($id_course);

        return view('update-course', ['course' => $course]);
    }



    function createCourse(Request $request)
    {
        Course::create([
            "name" => $request->input('name'),
            "description" => $request->input('description'),
            "date_start" => $request->input('date_start'),
            "date_end" => $request->input('date_end'),
            "active" => $request->input('active'),
        ]);
        $courses = Course::all();
        return view('courses', ['courses' => $courses]);
    }


    function updateCourse(Request $request)
    {
        
        
        $id_curso = $request->input('id_course');
        $active = $request->input('active');
        // Busca el curso con el ID que le pasan
        $curso = Course::find($id_curso);
        // Cambia el estado del curso dependiendo del valor que ingresa
        $curso->active = $active == 'on' ? 1 : 0;
        $curso->name = $request->input('name');
        $curso->description = $request->input('description');
        $curso->date_start = $request->input('date_start');
        $curso->date_end = $request->input('date_end');
        // Guarda la fila
        $curso->save();
        return redirect('/courses');
    }

    function deleteCourse(Request $request)
    {
        $id_course = $request->get('id');
        $course = Course::find($id_course);
        $course->delete();
        return redirect('/courses');
    }

}
