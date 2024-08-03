<?php

use App\Http\Controllers\Api\SettingApiController;
use App\Http\Middleware\ApiMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('setting')->middleware([ApiMiddleware::class])->group(function () {
    Route::get('', [SettingApiController::class, 'index']);
});