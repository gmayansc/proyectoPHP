<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ClasseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function getRoute()
    {
        // Busca todos los cursos
        $courses = Course::all();
        $teachers = Teacher::all();
        $classes = Classe::all();
        $schedules = Schedule::all();

        return view('classes', ['courses' => $courses, 'classes' => $classes, 'teachers' => $teachers, 'schedules' => $schedules]);
    }
    

    function createClasse(Request $request)
    {
        Classe::create([
            "name" => $request->input('name'),
            "description" => $request->input('description'),
            "date_start" => $request->input('date_start'),
            "date_end" => $request->input('date_end'),
            "active" => $request->input('active'),
        ]);
        $classes = Classe::all();
        return view('classes', ['classes' => $classes]);
    }


    function updateClasse(Request $request)
    {
        $id_curso = $request->input('id_Classe');
        $active = $request->input('active');
        // Busca el curso con el ID que le pasan
        $curso = Classe::find($id_curso);
        // Cambia el estado del curso dependiendo del valor que ingresa
        $curso->active = $active == 'on' ? 1 : 0;
        // Guarda la fila
        $curso->save();
        return redirect('/panel/cursos');
    }

    function deleteClasse(Request $request)
    {
        $id_class = $request->get('id');
        $classe = Classe::find($id_class);
        $classe->delete();
        return redirect('/Classes');
    }

}
