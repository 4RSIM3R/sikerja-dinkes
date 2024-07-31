<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginWebRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function form()
    {
        return view('auth.login');
    }

    public function store(LoginWebRequest $request)
    {
        $payload = $request->validated();

        $user = User::where('email', $payload['email'])->first();

        if (!$user && !Hash::check($payload['password'], $user->password)) {
            return redirect()->back()->withInput($payload)->withErrors(['email' => 'Invalid email or password']);
        }
    }
}
