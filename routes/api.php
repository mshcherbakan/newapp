<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api', 'track'])->group(function (){
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/create', [UserController::class, 'create']);
    Route::get('/user/delete/{user}', [UserController::class, 'delete']);
});
