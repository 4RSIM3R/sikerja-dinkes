<?php

use App\Http\Controllers\BackofficeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::as('user.')->prefix('backoffice/user')->middleware(['auth'])->group(function () {
    Route::get('', [UserController::class, 'index'])->name('index');
    Route::get('grid', [UserController::class, 'grid'])->name('grid');
});