<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Assignment;
use App\Models\User;

class BackofficeController extends Controller
{
    public function index()
    {
        $user = User::query()->count('id');
        $assignment = Assignment::query()->count('id');
        $activity = Activity::query()->count('id');
        return view('backoffice.index', compact('user', 'assignment', 'activity'));
    }
}
