<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [AuthController::class, 'form'])->name('login');
    Route::post('login', [AuthController::class, 'store'])->name('login');
});