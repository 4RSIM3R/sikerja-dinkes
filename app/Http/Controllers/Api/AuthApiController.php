<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginApiRequest;
use App\Models\User;
use App\Utils\WebResponseUtils;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{

    public function login(LoginApiRequest $request)
    {
        $payload = $request->validated();

        $user = User::where('email', $payload['email'])->first();

        if (!$user) {
            return WebResponseUtils::base(["message" => "Invalid email or password"], "authencation failed", 400);
        }

        if (!Hash::check($payload['password'], $user->password)) {
            return WebResponseUtils::base(["message" => "Invalid email or password"], "authencation failed", 400);
        }

        if ($user->getRoleNames()[0] != 'user') {
            return WebResponseUtils::base(["message" => "user should be user"], "authencation failed", 400);
        }

        try {
            $token = Auth::guard('api')->attempt($payload);

            return WebResponseUtils::base([
                "token" => $token,
                "expired_in" => Auth::guard("api")->factory()->getTTL() * 60,
                "role" => $user->getRoleNames()->first()
            ]);
        } catch (Exception $e) {
            return WebResponseUtils::base(["message" => $e->getMessage()], "authencation failed", 400);
        }
    }

}