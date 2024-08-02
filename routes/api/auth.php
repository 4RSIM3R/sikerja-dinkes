<?php

use App\Http\Controllers\Api\AuthApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthApiController::class, 'login']);

    Route::middleware('api')->group(function () {
        Route::post('logout', [AuthApiController::class, 'logout']);
    });
});