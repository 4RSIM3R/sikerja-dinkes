<?php

use App\Http\Controllers\Api\ProfileApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->middleware('api')->group(function () {
    Route::get('', [ProfileApiController::class, 'index']);
});