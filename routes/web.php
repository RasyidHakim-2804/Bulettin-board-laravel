<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

//user login
Route::middleware('auth')->group(function(){

  Route::get('/logout',[AuthController::class, 'logout']);

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

//user not login
Route::middleware('guest')->group(function(){

  Route::controller(AuthController::class)->group(function(){
    //login
    Route::get('/login','loginView')->name('login');
    Route::post('/login','login');

    //register
    Route::get('/register','registerView')->name('register');
    Route::post('/register','register');

  });

});


