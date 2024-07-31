<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::as('activity.')->prefix('backoffice/activity')->middleware(['auth'])->group(function () {
    Route::get('', [ActivityController::class, 'index'])->name('index');
});
