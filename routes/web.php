<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\Authentication;



//LOGIN AND REGISTER ROUTES (AUTH)
Route::get('/',[LoginController::class, 'getRoute']);
Route::get('/login-check',[Authentication::class, 'login']);
Route::get('/login-admin-check',[Authentication::class, 'loginAdmin']);
Route::get('/login-admin',[LoginAdminController::class, 'getRoute']);

Route::get('/register',[RegisterController::class, 'getRoute']);
Route::get('/register-check',[Authentication::class, 'registerStudent']);
Route::get('/register-test',[Authentication::class, 'registerTest']);


Route::get('/register-admin',[RegisterAdminController::class, 'getRoute']);
Route::get('/register-admin-check',[Authentication::class, 'registerAdmin']);

//HOME ROUTES
Route::get('/home',[HomeController::class, 'getRoute']);
Route::get('/home-admin',[HomeAdminController::class, 'getRoute']);
Route::get('/modify-profile', [HomeController::class, 'getRoute']);
Route::get('/calendar',[HomeController::class, 'getCalendar']);



//COURSES ROUTES
Route::get('/courses',[CourseController::class, 'getRoute']);
Route::post('/courses', [CourseController::class, 'createCourse']);
Route::post('/delete-courses', [CourseController::class, 'deleteCourse']);


//CLASSES ROUTES
Route::get('/classes',[ClasseController::class, 'getRoute']);
Route::post('/classes', [ClasseController::class, 'createClasse']);
Route::post('/delete-classes', [ClasseController::class, 'deleteClasse']);


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