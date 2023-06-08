<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


/* Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified']);

Route::get('/adduser', [UserController::class, 'addUserForm'])->name('adduser.form');
Route::post('/adduser', [UserController::class, 'addUser'])->name('adduser'); */

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/adduser', [UserController::class, 'addUserForm'])->name('adduser.form');
    Route::post('/adduser', [UserController::class, 'addUser'])->name('adduser');
});




Route::get('/userlist', [UserController::class, 'userlist']);
/* Route::get('/userlist', function () {
    return view('frontend.userlist');
}); */

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});



/* FORGOTPASSWORD */
Route::get('/forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('/forgot-password', [AuthController::class, 'postforgotpassword']);
Route::get('/reset/{token}', [AuthController::class, 'reset']);
Route::post('/reset/{token}', [AuthController::class, 'Postreset']);

/* GOOGLE LOGIN */
Route::get('auth/google',[AuthController::class,'loginwithgoogle'])->name('Glogin');
Route::any('auth/google/callback',[AuthController::class,'callbackFromGoogle'])->name('auth/google/callback');

/* CONFIRMATION */
Route::group(['middleware' => 'auth'], function () {
    /* Route::get('/', [HomeController::class, 'index']); */
    /* Route::delete('/logout', [AuthController::class, 'logout'])->name('logout'); */
});

/* Process Resend Email */
Route::get('resend-email',[AuthController::class,'resendconfirm_email'])->name('resend-email');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

 /* เมื่อกดยืนยันอีเมลล์ในเมลล์ */
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

/* LOG OUT */
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');