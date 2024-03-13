<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\ContactsController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'HomeIndex']);
Route::post('/contactSend',[HomeController::class,'ContactSend']);


Route::get('/policy',[PolicyController::class,'index']);
Route::get('/terms',[TermsController::class,'index']);

Route::get('/contact',[ContactsController::class,'index']);
