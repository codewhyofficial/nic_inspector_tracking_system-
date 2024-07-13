<?php

use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\ValidateToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo "Hello";
})->name('home');

// login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// captcha route
Route::get('/captcha', [CaptchaController::class, 'generateCaptcha'])->name('captcha');

Route::get('/inspector/add', function(){
    return view('addInspector');
});

Route::get('/inspector/update', function(){
    return view('updateInspector');
});

Route::get('/visit/add', function(){
    return view('addVisit');
});


Route::get('/visit/update', function(){
    return view('updateVisit');
});

