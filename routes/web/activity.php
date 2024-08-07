<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::as('activity.')->prefix('backoffice/activity')->middleware(['auth'])->group(function () {
    Route::get('', [ActivityController::class, 'index'])->name('index');
    Route::get('grid', [ActivityController::class, 'grid'])->name('grid');
    Route::get('trash', [ActivityController::class, 'trash'])->name('trash');
    Route::get('create', [ActivityController::class, 'form'])->name('create');
    Route::post('create', [ActivityController::class, 'store'])->name('store');
    Route::get('{id}', [ActivityController::class, 'detail'])->name('detail');
    Route::put('{id}', [ActivityController::class, 'update'])->name('edit');
    Route::delete('{id}', [ActivityController::class, 'destroy'])->name('destroy');

    Route::get('deleted', [ActivityController::class, 'deletedData'])->name('deletedData');
    Route::post('{id}', [ActivityController::class, 'restore'])->name('restore');
    Route::delete('forceDelete/{id}', [ActivityController::class, 'forceDelete'])->name('forceDelete');
});

Route::get('backoffice/activity/{id}/report', [ActivityController::class, 'report'])->name('activity.report');
