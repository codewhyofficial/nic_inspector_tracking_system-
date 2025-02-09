<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    LoginController,
    LogoutController,
    CaptchaController,
    AdminController,
    UserController,
    InspectorController,
    InspectionController,
    VisitController,
    ForgotPasswordController,
    ChangePasswordController,
    ResetPasswordController
};

use App\Http\Middleware\{
    AuthenticateUser,
    EnsureAdminRole,
    EnsureUserRole
};

Route::get('/', function(){ return view('home');})->name('home');

// Authentication routes
Route::middleware(AuthenticateUser::class)->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});

// Change Password route
Route::get('/password/change', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change')->middleware(AuthenticateUser::class);
Route::post('/password/change', [ChangePasswordController::class, 'changePassword'])->middleware(AuthenticateUser::class);
Route::get('/password/skip', [ChangePasswordController::class, 'skipChangePassword'])->name('password.skip')->middleware(AuthenticateUser::class);

// reset password route
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// CAPTCHA route
Route::get('/captcha', [CaptchaController::class, 'generateCaptcha'])->name('captcha');

// admin route
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware([AuthenticateUser::class, EnsureAdminRole::class]);

// user route
Route::get('/user/{uiid}', [UserController::class, 'index'])->name('user')->middleware([AuthenticateUser::class, EnsureUserRole::class]);

// user exists check 
Route::get('/check-email', [InspectorController::class, 'checkEmail'])->name('checkEmail')->middleware(AuthenticateUser::class);

// Inspector route 
Route::get('/inspector/add', [InspectorController::class, 'showAddInspectorPage'])->name('addInspector')->middleware([AuthenticateUser::class, EnsureAdminRole::class]);
Route::post('/inspector/add', [InspectorController::class, 'Add'])->name('addInspector')->middleware([AuthenticateUser::class, EnsureAdminRole::class]);
Route::get('/inspector/update/{uiid}', [InspectorController::class, 'showUpdateInspectorPage'])->name('updateInspector')->middleware(AuthenticateUser::class);
Route::post('/inspector/update/{uiid}', [InspectorController::class, 'Update'])->name('updateInspector')->middleware(AuthenticateUser::class);
Route::delete('/inspector/delete/{uiid}', [InspectorController::class, 'delete'])->name('deleteInspector')->middleware([AuthenticateUser::class, EnsureAdminRole::class]);

// active status route
Route::post('/update-active-status/{uiid}', [InspectorController::class, 'updateActiveStatus'])->middleware([AuthenticateUser::class, EnsureAdminRole::class]);

// Inspection route
Route::get('/user/{uiid}/inspection/add', [InspectionController::class, 'showAddInspectionPage'])->name('addInspection')->middleware(AuthenticateUser::class);
Route::post('/user/{uiid}/inspection/add', [InspectionController::class, 'Add'])->name('addInspection')->middleware(AuthenticateUser::class);
Route::get('/user/{uiid}/inspection/update/{id}', [InspectionController::class, 'showUpdateInspectionPage'])->name('updateInspection')->middleware(AuthenticateUser::class);
Route::post('/user/{uiid}/inspection/update/{id}', [InspectionController::class, 'Update'])->name('updateInspection')->middleware(AuthenticateUser::class);
Route::delete('/user/{uiid}/inspection/delete/{id}', [InspectionController::class, 'delete'])->name('deleteInspection')->middleware(AuthenticateUser::class);

// Visit route
Route::get('/user/{uiid}/visit/add', [VisitController::class, 'showAddVisitPage'])->name('addVisit')->middleware([AuthenticateUser::class]);
Route::post('/user/{uiid}/visit/add', [VisitController::class, 'Add'])->name('addVisit')->middleware([AuthenticateUser::class]);
Route::get('/user/{uiid}/visit/update/{id}', [VisitController::class, 'showUpdateVisitPage'])->name('updateVisit')->middleware([AuthenticateUser::class]);
Route::post('/user/{uiid}/visit/update/{id}', [VisitController::class, 'update'])->name('updateVisit')->middleware([AuthenticateUser::class]);
Route::delete('/user/{uiid}/visit/delete/{id}', [VisitController::class, 'delete'])->name('deleteVisit')->middleware(AuthenticateUser::class);

