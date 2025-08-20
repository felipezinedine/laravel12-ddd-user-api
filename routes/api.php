<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{AuthController, UserController};


Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api', 'prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/store', [UserController::class, 'store']);
    Route::post('/update/{id}', [UserController::class, 'update']);
    Route::get('/delete/{id}', [UserController::class, 'delete']);
});
