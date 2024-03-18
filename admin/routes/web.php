<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['login'])->group(function () {
    Route::get('/', [HomeController::class, 'HomeIndex']);
    Route::get('/visitor', [VisitorController::class, 'VisitorIndex']);

    // Service
    Route::get('/service', [ServiceController::class, 'ServiceIndex']);
    Route::get('/getServicesData', [ServiceController::class, 'getServiceData']);
    Route::post('/serviceDelete', [ServiceController::class, 'ServiceDelete']);
    Route::post('/serviceDetails', [ServiceController::class, 'getServiceDetails']);
    Route::post('/serviceUpdate', [ServiceController::class, 'ServiceUpdate']);
    Route::post('/serviceAdd', [ServiceController::class, 'ServiceAdd']);

    // courses
    Route::get('/courses', [CoursesController::class, 'CoursesIndex']);
    Route::get('/getCoursesData', [CoursesController::class, 'getCoursesData']);
    Route::post('/courseDelete', [CoursesController::class, 'CourseDelete']);
    Route::post('/courseDetails', [CoursesController::class, 'getCourseDetails']);
    Route::post('/courseUpdate', [CoursesController::class, 'CourseUpdate']);
    Route::post('/courseAdd', [CoursesController::class, 'CourseAdd']);

    // projects
    Route::get('/projects', [ProjectsController::class, 'ProjectIndex']);
    Route::get('/getProjectsData', [ProjectsController::class, 'getProjectsData']);
    Route::post('/projectDelete', [ProjectsController::class, 'ProjectDelete']);
    Route::post('/projectDetails', [ProjectsController::class, 'getProjectDetails']);
    Route::post('/projectUpdate', [ProjectsController::class, 'ProjectUpdate']);
    Route::post('/projectAdd', [ProjectsController::class, 'ProjectAdd']);

    // contact
    Route::get('/contact', [ContactController::class, 'ContactIndex']);
    Route::get('/getContactData', [ContactController::class, 'getContactData']);
    Route::post('/contactDelete', [ContactController::class, 'contactDelete']);

    // review
    Route::get('/review', [ReviewController::class, 'ReviewIndex']);
    Route::get('/getReviewData', [ReviewController::class, 'getReviewData']);
    Route::post('/reviewDelete', [ReviewController::class, 'ReviewDelete']);
    Route::post('/reviewDetails', [ReviewController::class, 'getReviewDetails']);
    Route::post('/reviewUpdate', [ReviewController::class, 'ReviewUpdate']);
    Route::post('/reviewAdd', [ReviewController::class, 'ReviewAdd']);

    // photo gallery

    Route::get('/gallery', [PhotoController::class, 'index']);
    Route::post('/upload', [PhotoController::class, 'Upload']);
    Route::get('/photojson', [PhotoController::class, 'PhotoJson']);
    Route::get('/photojsonbyid/{id}', [PhotoController::class, 'PhotoJsonByID']);
    Route::post('/photodelete', [PhotoController::class, 'delete']);
});

Route::get('/login', [LoginController::class, 'index']);
Route::post('/onLogin', [LoginController::class, 'onLogin']);
Route::get('/logout', [LoginController::class, 'onLogout']);
