<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginWebRequest;
use App\Models\User;
use App\Traits\AuthTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use AuthTrait;

    public function form()
    {
        return view('auth.login');
    }

    public function store(LoginWebRequest $request)
    {
        $payload = $request->validated();

        $user = User::where('email', $payload['email'])->first();

        if (!$user) {
            return redirect()->back()->withInput($payload)->withErrors(['email' => 'Invalid email or password']);
        }

        if (!Hash::check($payload['password'], $user->password)) {
            return redirect()->back()->withInput($payload)->withErrors(['email' => 'Invalid email or password']);
        }

        if ($user->getRoleNames()[0] != 'admin') {
            return redirect()->back()->withInput($payload)->withErrors(['email' => 'User should be admin']);
        }

        if ($user = Auth::attempt($payload)) {
            return redirect()->route('backoffice.index');
        } else {
            return redirect()->back()->withInput($payload)->withErrors(['email' => 'Invalid email or password']);
        }
    }

    
}
