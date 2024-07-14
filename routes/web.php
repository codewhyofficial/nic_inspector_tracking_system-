<?php

use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\InspectorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\VisitController;
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

// Inspector route 
Route::get('/inspector/add', [InspectorController::class, 'showAddInspectorPage'])->name('addInspector');
Route::post('/inspector/add', [InspectorController::class, 'Add'])->name('addInspector');
Route::get('/inspector/update', [InspectorController::class, 'showUpdateInspectorPage']);

// Visit route
Route::get('/visit/add', [VisitController::class, 'showAddVisitPage']);
Route::get('/visit/update', [VisitController::class, 'showUpdateVisitPage']);

