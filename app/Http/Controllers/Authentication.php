<?php

namespace App\Http\Controllers;

use Illuminate\Http\Input;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Admin;
use Illuminate\Support\Facades\Cookie;

class Authentication extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    // Login function
    function login(Request $request)
    {
        $student = Student::where('email', $request->input('email'))->first();

        if ($student) {
            if ($student->pass == $request->input('password')) {
                Cookie::queue('id', $student->id_student, 200);
                return redirect('/home');
            }
            return view('index', ["invalid" => true]);
        }

        return view('index', ["invalid" => true]);
    }

    // Login function
    function loginAdmin(Request $request)
    {
        $admin = Admin::where('email', $request->input('email'))->first();

        if ($admin) {
            if ($admin->pass == $request->input('password')) {
                Cookie::queue('id_admin', $admin->id_admin, 200);
                return redirect('/home-admin');
            }
            return view('login-admin', ["invalid" => true]);
        }

        return view('login-admin', ["invalid" => true]);
    }

    // Sign in funtion
    function register(Request $request)
    {
        // Creamos las reglas para validar la petición
        // $rules = [
        //     "username" => "required",
        //     "pass" => "required|integer",
        //     "email" => "required|email",
        //     "name" => "required",
        //     "surname" => "required",
        //     "telephone" => "required",
        //     "nif" => "required",
        // ];

        //     $request->validate($rules);

        try {
            Student::create([
                "username" => $request->input('username'),
                "pass" => $request->input('pass'),
                "email" => $request->input('email'),
                "name" => $request->input('name'),
                "surname" => $request->input('surname'),
                "telephone" => $request->input('telephone'),
                "nif" => $request->input('nif'),
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Si hay error duplicado
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return view('register', ["done" => false, "duplicado" => true]);
            }
            return view('register');
        }
        return view('home');
    }


















    // // Función vista fomulario ingresar
    // function mostrarIngresar()
    // {
    //     return view('ingresar', ["invalid" => false]);
    // }

    // // Función vista formulario registro
    // function mostrarRegistro()
    // {
    //     return view('registro', ["done" => false, "duplicado" => false]);
    // }

    // // Función registrar
    // function registrar(Request $request)
    // {
    //     // Creamos las reglas para validar la petición
    //     $rules = [
    //         "username" => "required",
    //         "pass" => "required|integer",
    //         "email" => "required|email",
    //         "name" => "required",
    //         "surname" => "required",
    //         "telephone" => "required",
    //         "nif" => "required",
    //     ];
    //     // Validamos la petición con las reglas antes creadas
    //     $request->validate($rules, [
    //         "pass.integer" => "La contraseña debe ser un entero"
    //     ]);

    //     try {
    //         // Creamos el estudiante en caso de que sea un registro de tipo estudiante
    //         if ($request->input('type') == 'ESTUDIANTE') {
    //             Student::create([
    //                 "username" => $request->input('username'),
    //                 "pass" => $request->input('pass'),
    //                 "email" => $request->input('email'),
    //                 "name" => $request->input('name'),
    //                 "surname" => $request->input('surname'),
    //                 "telephone" => $request->input('telephone'),
    //                 "nif" => $request->input('nif'),
    //             ]);
    //             // Creamos profesor en caso de que sea un registro de tipo profesor
    //         } else if ($request->input('type') == 'PROFESOR') {
    //             Teacher::create([
    //                 "pass" => $request->input('pass'),
    //                 "email" => $request->input('email'),
    //                 "name" => $request->input('name'),
    //                 "surname" => $request->input('surname'),
    //                 "telephone" => $request->input('telephone'),
    //                 "nif" => $request->input('nif'),
    //             ]);
    //         }
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         // Si hay error duplicado
    //         $errorCode = $e->errorInfo[1];
    //         if ($errorCode == '1062') {
    //             // Enviamos vista registro con las flags necesarias
    //             return view('registro', ["done" => false, "duplicado" => true]);
    //         }
    //         return view('registro', ["done" => false, "duplicado" => false, "type" => $request->input('type')])->withErrors();

    //     }
    //     /// Enviamos la vista de registro con las flags necesarias
    //     return view('registro', ["done" => true, "duplicado" => false, "type" => $request->input('type')]);
    // }


    // // Función ingresar
    // function ingresar(Request $request)
    // {
    //     $student = Student::where('email', $request->input('email'))->first();
    //     $teacher = Teacher::where('email', $request->input('email'))->first();
    //     $admin = Admin::where('email', $request->input('email'))->first();

    //     // Encontró estudiante, hacemos login como estudiante
    //     if ($student) {
    //         if ($student->pass == $request->input('password')) {
    //             // Enviamos vista panel con el rol de estudiante en las cookies
    //             return redirect('/panel')->cookie('rol', 'ESTUDIANTE', 200)->cookie('id', $student->id, 200);
    //         }
    //         return view('ingresar', ["invalid" => true]);
    //     }

    //     // Encontró profesor, hacemos login como profesor
    //     if ($teacher) {
    //         if ($teacher->pass == $request->input('password')) {
    //             // Redireccionamos a panel con el rol de profesor en las cookies
    //             return redirect('/panel')->cookie('rol', 'PROFESOR', 200)->cookie('id', $teacher->id_teacher, 200);
    //         }
    //         return view('ingresar', ["invalid" => true]);
    //     }

    //     // Encontró admin, hacemos login como admin
    //     if ($admin) {
    //         if ($admin->pass == $request->input('password')) {
    //             // Redireccionamos a panel con el rol de admin en las cookies
    //             return redirect('/panel')->cookie('rol', 'ADMIN', 200)->cookie('id', $admin->id_user_admin, 200);
    //         }
    //         return view('ingresar', ["invalid" => true]);
    //     }

    //     return view('ingresar', ["invalid" => true]);
    // }

    // // Función Logout
    // function desconectar()
    // {
    //     // Borramos cookie de rol y redireccionamos al ingresar
    //     return redirect('/ingresar')->cookie(Cookie::forget('rol'));
    // }
}
