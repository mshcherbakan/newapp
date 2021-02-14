<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function(){

    Route::get('/', function (){
        return view('dashboard');
    })->name('home');

    Route::get('/dashboard', function (){
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('dashboard');
    })->name('profile.edit');

    Route::get('/users', [UserController::class, 'index'])->name('users');
});

require __DIR__.'/auth.php';
