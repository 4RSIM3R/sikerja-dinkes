<?php

use Illuminate\Support\Facades\Route;

Route::prefix('activity')->middleware('api')->group(function () {
    Route::get('/', [ActivityApiController::class, 'index']);
    Route::get('/{id}', [ActivityApiController::class, 'show']);
    Route::post('/', [ActivityApiController::class, 'store']);
});