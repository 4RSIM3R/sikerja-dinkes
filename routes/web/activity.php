<?php

use Illuminate\Support\Facades\Route;

Route::as('activity.')->prefix('backoffice/activity')->middleware(['auth'])->group(function () {
    Route::get('', [\App\Http\Controllers\ActivityController::class, 'index'])->name('index');
});
