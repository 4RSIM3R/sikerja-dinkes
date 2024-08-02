<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('blog', ActivityController::class);