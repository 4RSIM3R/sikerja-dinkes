<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginWebRequest;

class AuthController extends Controller
{
    public function form()
    {
        return view('auth.login');
    }

    public function store(LoginWebRequest $request)
    {
        $payload = $request->validated();
    }
}
