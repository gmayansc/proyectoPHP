<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;


Route::get('/',[LoginController::class, 'getRoute']);
Route::get('/login-admin',[LoginAdminController::class, 'getRoute']);
Route::get('/register',[RegisterController::class, 'getRoute']);
Route::get('/register-admin',[RegisterAdminController::class, 'getRoute']);
Route::get('/home',[HomeController::class, 'getRoute']);
Route::get('/courses',[CourseController::class, 'getRoute']);


/*

////////  HAY QUE CREAR UN CONTROLADOR POR CADA RUTA O CONJUNTO (CoursesController, ClassesController, etc.). 
////////  Dentro de cada controlador crear un método que devuelva la vista correspondiente HTML


Route::get('/classes');
Route::get('/courses');
Route::get('/create-classes');
Route::get('/create-courses');
Route::get('/delete-courses');
Route::get('/delete-admins');
Route::get('/delete-classes');
Route::get('/delete-teachers');
Route::get('/edit-profile');
Route::get('/home-admin');
Route::get('/home');
Route::get('/login-admin');
Route::get('/login-professor');
Route::get('/logout');
Route::get('/modify-profile');
Route::get('/register-admin');
Route::get('/register-professor');
Route::get('/register');
Route::get('/students');
Route::get('/teachers');
Route::get('/update-classes');
Route::get('/update-courses');
Route::get('/update-teachers');
*/



Route::get('/leer', function(){

    $students = App\Models\Student::all();
    
    foreach($students as $student) {
        echo $student->name . " | " . $student->surname . "<br>";
    }
});