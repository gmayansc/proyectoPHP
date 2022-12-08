<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


Route::get('/',[LoginController::class, 'index']);

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

