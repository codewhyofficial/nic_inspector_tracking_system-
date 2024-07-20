<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\InspectorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use App\Http\Middleware\AuthenticateUser;
use App\Http\Middleware\EnsureAdminRole;
use App\Http\Middleware\EnsureUserRole;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){ return view('home');})->name('home');

// login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware(AuthenticateUser::class);
Route::post('/login', [LoginController::class, 'login']);

// logout route
Route::post('/logout', [LogoutController::class, 'handle'])->name('logout');

// captcha route
Route::get('/captcha', [CaptchaController::class, 'generateCaptcha'])->name('captcha');

// admin route
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware([AuthenticateUser::class, EnsureAdminRole::class]);

// user route
Route::get('/user', [UserController::class, 'index'])->name('user')->middleware([AuthenticateUser::class, EnsureUserRole::class]);

// Inspector route 
Route::get('/inspector/add', [InspectorController::class, 'showAddInspectorPage'])->name('addInspector');
Route::post('/inspector/add', [InspectorController::class, 'Add'])->name('addInspector');
Route::get('/inspector/update/{uiid}', [InspectorController::class, 'showUpdateInspectorPage'])->name('updateInspector');
Route::post('/inspector/update/{uiid}', [InspectorController::class, 'Update'])->name('updateInspector');

// Visit route
Route::get('/visit/add', [VisitController::class, 'showAddVisitPage']);
Route::get('/visit/update', [VisitController::class, 'showUpdateVisitPage']);

