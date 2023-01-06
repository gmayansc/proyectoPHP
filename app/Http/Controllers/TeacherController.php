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

class TeacherController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function getRoute()
    {
        // Busca todos los profesores
        $teachers = Teacher::all();

        return view('teachers', ['teachers' => $teachers]);
    }
    

    function createTeacher(Request $request)
    {
        Teacher::create([
            "id_teacher" => $request->input('id_teacher'),
            "name" => $request->input('name'),
            "surname" => $request->input('surname'),
            "email" => $request->input('email'),
            "telephone" => $request->input('telephone'),
            "nif" => $request->input('nif'),
        ]);
        return redirect('teachers');
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
