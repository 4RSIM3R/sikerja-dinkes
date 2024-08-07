<?php

use App\Http\Controllers\AssignmentController;
use Illuminate\Support\Facades\Route;

Route::as('assignment.')->prefix('backoffice/assignment')->middleware(['auth'])->group(function () {
    Route::get('', [AssignmentController::class, 'index'])->name('index');
    Route::get('grid', [AssignmentController::class, 'grid'])->name('grid');
    Route::get('create', [AssignmentController::class, 'form'])->name('create');
    Route::post('create', [AssignmentController::class, 'store'])->name('store');
    //Route::get('{id}', [AssignmentController::class, 'detail'])->name('detail'); //saya command sementara karena jika di uncommand ini error
    Route::put('{id}', [AssignmentController::class, 'update'])->name('edit');

    Route::get('deleted', [AssignmentController::class, 'deleted'])->name('deleted');
    Route::get('trash', [AssignmentController::class, 'trash'])->name('trash');
    Route::post('{id}', [AssignmentController::class, 'restore'])->name('restore');
    Route::get('create', [AssignmentController::class, 'form'])->name('create');
    Route::delete('{id}', [AssignmentController::class, 'destroy'])->name('destroy');
    Route::delete('forceDelete/{id}', [AssignmentController::class, 'forceDelete'])->name('forceDelete');
});