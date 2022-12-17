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
        // Guarda la fila
        $curso->save();
        return redirect('/panel/cursos');
    }

    function deleteCourse(Request $request)
    {
        $id_course = $request->get('id');
        $course = Course::find($id_course);
        $course->delete();
        return redirect('/courses');
    }

}
