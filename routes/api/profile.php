<?php

use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Middleware\ApiMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->middleware([ApiMiddleware::class])->group(function () {
    Route::get('', [ProfileApiController::class, 'index']);
});