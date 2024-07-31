<?php

use App\Http\Controllers\BackofficeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'backoffice', 'middleware' => ['auth']], function () {
    Route::get('', [BackofficeController::class, 'index'])->name('backoffice.index');
});