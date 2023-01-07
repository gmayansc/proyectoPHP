<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Student;
use App\Models\Classe;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function getRoute()
    {
        $works = Work::all();
        $classes = Classe::all();
        $students = Student::all();

        return view('works', ['works' => $works,'classes' => $classes,'students' => $students]);
    }

    public function getUpdateWorkRoute(Request $request)
    {
        $id_work = $request->get('id');
        $work = Work::find($id_work);

        return view('update-work', ['work' => $work]);
    }



    function createWork(Request $request)
    {
        Work::create([
            "name" => $request->input('name'),
            "id_class" => $request->input('id_class'),
            "id_student" => $request->input('id_student'),
            "mark" => $request->input('mark'),
        ]);

        return redirect('/works');
    }


    function updateWork(Request $request)
    {


        $id_curso = $request->input('id_work');
        $active = $request->input('active');
        // Busca el curso con el ID que le pasan
        $curso = Work::find($id_curso);
        // Cambia el estado del curso dependiendo del valor que ingresa
        $curso->active = $active == 'on' ? 1 : 0;
        $curso->name = $request->input('name');
        $curso->description = $request->input('description');
        $curso->date_start = $request->input('date_start');
        $curso->date_end = $request->input('date_end');
        // Guarda la fila
        $curso->save();
        return redirect('/works');
    }

    function deleteWork(Request $request)
    {
        $id_work = $request->get('id');
        $work = Work::find($id_work);
        $work->delete();
        return redirect('/works');
    }

}
