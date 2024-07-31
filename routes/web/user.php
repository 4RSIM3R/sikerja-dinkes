<?php

use App\Http\Controllers\BackofficeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::as('user.')->prefix('backoffice/user')->middleware(['auth'])->group(function () {
    Route::get('', [UserController::class, 'index'])->name('index');
    Route::get('grid', [UserController::class, 'grid'])->name('grid');
    Route::get('create', [UserController::class, 'form'])->name('create');
    Route::post('create', [UserController::class, 'store'])->name('create');
    Route::get('{id}', [UserController::class, 'detail'])->name('detail');
    Route::put('{id}', [UserController::class, 'update'])->name('edit');
    Route::delete('{id}', [UserController::class, 'destroy'])->name('destroy');
});