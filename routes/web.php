<?php

use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VerifyController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
 

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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::redirect('/home', '/');

// Route::get('/testEmail', function() {

//   // The email sending is done using the to method on the Mail facade
//   Mail::to('testreceiver@gmail.com’')->send(new MyTestEmail());
// });


//user login
Route::middleware(['auth', 'verified'])->group(function(){


  Route::controller(PostController::class)->group(function(){
    //view
    Route::get('/post', 'create')->name('post');
    Route::get('/edit/{id}', 'edit')->name('edit');

    //action crud
    Route::post('/post', 'store');
    Route::post('/edit/{id}', 'update');
    Route::get('/delete/{id}', 'delete');
  });

});

Route::get('/logout',[AuthController::class, 'logout'])->middleware('auth');

//guest user
Route::middleware('guest')->group(function(){

  Route::controller(AuthController::class)->group(function(){
    //login
    Route::get('/login','loginView')->name('login');
    Route::post('/login','login');

    //register
    Route::get('/registration','registerView')->name('registration');
    Route::post('/register','register');

  });

});

//verification route

Route::controller(VerifyController::class)->group(function(){

  Route::get('/email/verify','notice')
  ->middleware('auth')
  ->name('verification.notice');

  Route::get('/email/verify/{id}/{hash}','verify')
  ->middleware(['auth', 'signed'])
  ->name('verification.verify');

});


