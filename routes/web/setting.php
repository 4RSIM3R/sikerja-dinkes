<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::as('setting.')->prefix('backoffice/setting')->middleware(['auth'])->group(function () { 
    Route::get('web', [SettingController::class, 'web_index'])->name('web');
    Route::get('app', [SettingController::class, 'app_index'])->name('app');
    Route::post('web', [SettingController::class, 'web_update'])->name('web');
    Route::post('app', [SettingController::class, 'app_update'])->name('app');
});