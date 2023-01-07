<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\Authentication;



//LOGIN AND REGISTER ROUTES (AUTH)
Route::get('/',[LoginController::class, 'getRoute']);
Route::get('/login-check',[Authentication::class, 'login']);
Route::get('/login-admin-check',[Authentication::class, 'loginAdmin']);
Route::get('/login-admin',[LoginAdminController::class, 'getRoute']);
Route::get('/logout',[Authentication::class, 'logout']);


Route::get('/register',[RegisterController::class, 'getRoute']);
Route::get('/register-check',[Authentication::class, 'registerStudent']);
Route::get('/register-test',[Authentication::class, 'registerTest']);


Route::get('/register-admin',[RegisterAdminController::class, 'getRoute']);
Route::get('/register-admin-check',[Authentication::class, 'registerAdmin']);

//HOME ROUTES
Route::get('/home',[HomeController::class, 'getRoute']);
Route::get('/home-admin',[HomeAdminController::class, 'getRoute']);
Route::get('/modify-profile', [HomeController::class, 'modifyProfile']);
Route::get('/modify-profile-submit', [HomeController::class, 'updateProfile']);


Route::post('/enrollment',[HomeController::class, 'enrollment']);




//COURSES ROUTES
Route::get('/courses',[CourseController::class, 'getRoute']);
Route::post('/courses', [CourseController::class, 'createCourse']);
Route::post('/delete-courses', [CourseController::class, 'deleteCourse']);
Route::post('/update-course', [CourseController::class, 'getUpdateCourseRoute']);
Route::get('/update-course-submit', [CourseController::class, 'updateCourse']);


//CLASSES ROUTES
Route::get('/classes',[ClasseController::class, 'getRoute']);
Route::get('/create-classes', [ClasseController::class, 'createClasse']);
Route::post('/delete-classes', [ClasseController::class, 'deleteClasse']);

//TEACHERS ROUTES
Route::get('/teachers',[TeacherController::class, 'getRoute']);
Route::post('/teachers', [TeacherController::class, 'createTeacher']);

//STUDENTS ROUTES
Route::get('/students',[StudentController::class, 'getRoute']);


//EXAMS ROUTES
Route::get('/exams',[ExamController::class, 'getRoute']);
Route::post('/exams', [ExamController::class, 'createExam']);


//WORKS ROUTES
Route::get('/works',[WorkController::class, 'getRoute']);
Route::post('/works', [WorkController::class, 'createWork']);


