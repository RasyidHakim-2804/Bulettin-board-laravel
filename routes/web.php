<?php

use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\VerifyController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/testEmail', function() {

//   // The email sending is done using the to method on the Mail facade
//   Mail::to('testreceiver@gmail.com’')->send(new MyTestEmail());
// });


//post
Route::middleware('auth')->group(function () {

  Route::middleware('verified')->group(function () {

    Route::resource('posts', PostController::class);
    Route::resource('comments', CommentController::class);
  
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::redirect('/home', '/');
  });

  Route::get('/logout', [AuthController::class, 'logout']);
});


//guest 
Route::middleware('guest')->group(function () {

  Route::controller(AuthController::class)->group(function () {
    //login
    Route::get('/login', 'loginView')->name('login');
    Route::post('/login', 'login');

    //register
    Route::get('/registration', 'registerView')->name('registration');
    Route::post('/register', 'register');
  });

  //reset password
  Route::controller(ForgotPasswordController::class)->group(function () {

    //forgot-password
    Route::get('/forgot-password', 'forgotPasswordView')->name('password.request');
    Route::post('/forgot-password', 'sendLink')->name('password.email');

    //reset password
    Route::get('/reset-password/{token}', 'resetPasswordView')->name('password.reset');
    Route::post('/reset-password', 'updatePassword')->name('password.update');
  });
});

//verification route

Route::controller(VerifyController::class)->group(function () {

  Route::get('/email/verify', 'notice')
    ->middleware('auth')
    ->name('verification.notice');

  Route::get('/email/verify/{id}/{hash}', 'verify')
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

  Route::post('/email/verification-notification', 'resend')
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');
});
