<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'HomeIndex']);
Route::post('/contactSend',[HomeController::class,'ContactSend']);