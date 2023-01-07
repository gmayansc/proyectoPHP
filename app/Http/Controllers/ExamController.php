<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Student;
use App\Models\Classe;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function getRoute()
    {
        $exams = Exam::all();
        $classes = Classe::all();
        $students = Student::all();

        return view('exams', ['exams' => $exams,'classes' => $classes,'students' => $students]);
    }

    public function getUpdateExamRoute(Request $request)
    {
        $id_exam = $request->get('id');
        $exam = Exam::find($id_exam);

        return view('update-exam', ['exam' => $exam]);
    }



    function createExam(Request $request)
    {
        Exam::create([
            "name" => $request->input('name'),
            "id_class" => $request->input('id_class'),
            "id_student" => $request->input('id_student'),
            "mark" => $request->input('mark'),
        ]);
       
        return redirect('exams');
    }


    function updateExam(Request $request)
    {
        
        
        $id_curso = $request->input('id_exam');
        $active = $request->input('active');
        // Busca el curso con el ID que le pasan
        $curso = Exam::find($id_curso);
        // Cambia el estado del curso dependiendo del valor que ingresa
        $curso->active = $active == 'on' ? 1 : 0;
        $curso->name = $request->input('name');
        $curso->description = $request->input('description');
        $curso->date_start = $request->input('date_start');
        $curso->date_end = $request->input('date_end');
        // Guarda la fila
        $curso->save();
        return redirect('/exams');
    }

    function deleteExam(Request $request)
    {
        $id_exam = $request->get('id');
        $exam = Exam::find($id_exam);
        $exam->delete();
        return redirect('/exams');
    }

}
