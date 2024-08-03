<?php

use App\Http\Controllers\Api\ActivityApiController;
use App\Http\Middleware\ApiMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('activity')->middleware([ApiMiddleware::class])->group(function () {
    Route::get('', [ActivityApiController::class, 'index']);
    Route::get('{id}', [ActivityApiController::class, 'show']);
    Route::post('{id}/attendance', [ActivityApiController::class, 'attendance']);
    Route::post('{id}/reimbursement', [ActivityApiController::class, 'reimbursement']);
});
