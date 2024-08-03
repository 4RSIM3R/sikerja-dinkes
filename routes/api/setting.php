<?php

use App\Http\Controllers\Api\SettingApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('setting')->middleware('api')->group(function () {
    Route::get('', [SettingApiController::class, 'index']);
});