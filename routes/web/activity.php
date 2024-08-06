<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::as('activity.')->prefix('backoffice/activity')->middleware(['auth'])->group(function () {
    Route::get('', [ActivityController::class, 'index'])->name('index');
    Route::get('grid', [ActivityController::class, 'grid'])->name('grid');
    Route::get('deleted', [ActivityController::class, 'deleted'])->name('deleted');
    Route::get('trash', [ActivityController::class, 'trash'])->name('trash');
    Route::post('{id}', [ActivityController::class, 'restore'])->name('restore');
    Route::get('create', [ActivityController::class, 'form'])->name('create');
    Route::post('create', [ActivityController::class, 'store'])->name('store');
    Route::get('{id}', [ActivityController::class, 'detail'])->name('detail');
    Route::put('{id}', [ActivityController::class, 'update'])->name('edit');
    Route::delete('{id}', [ActivityController::class, 'destroy'])->name('destroy');
    Route::delete('{id}', [ActivityController::class, 'forceDelete'])->name('forceDelete');
});