<?php

use App\Http\Controllers\Auth\OauthController;
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

Route::get('/login-code', [OauthController::class, 'create'])->name('oauth.code');
Route::post('/login-code', [OauthController::class, 'store'])->name('oauth.store');
Route::get('/github/redirect', [OauthController::class, 'githubRedirect'])->name('github.redirect');
Route::get('/github/callback', [OauthController::class, 'githubCallback'])->name('github.callback');
Route::get('/google/redirect', [OauthController::class, 'googleRedirect'])->name('google.redirect');
Route::get('/google/callback', [OauthController::class, 'googleCallback'])->name('google.callback');

require __DIR__.'/auth.php';
require __DIR__.'/api.php';
