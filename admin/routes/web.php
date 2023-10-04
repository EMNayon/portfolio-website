<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'HomeIndex']);
Route::get('/visitor',[VisitorController::class,'VisitorIndex']);

// Service
Route::get('/service',[ServiceController::class,'ServiceIndex']);
Route::get('/getServicesData',[ServiceController::class,'getServiceData']);
Route::post('/serviceDelete',[ServiceController::class,'ServiceDelete']);
Route::post('/serviceDetails',[ServiceController::class,'getServiceDetails']);
Route::post('/serviceUpdate',[ServiceController::class,'ServiceUpdate']);
Route::post('/serviceAdd',[ServiceController::class,'ServiceAdd']);

// courses
Route::get('/courses', [CoursesController::class, 'CoursesIndex']);
Route::get('/getCoursesData',[CoursesController::class,'getCoursesData']);
Route::post('/courseDelete',[CoursesController::class,'CourseDelete']);
Route::post('/courseDetails',[CoursesController::class,'getCourseDetails']);
Route::post('/courseUpdate',[CoursesController::class,'CourseUpdate']);
Route::post('/courseAdd',[CoursesController::class,'CourseAdd']);
