<?php

namespace App\Http\Controllers\Api;

use App\Contract\UserContract;
use App\Http\Controllers\Controller;
use App\Utils\WebResponseUtils;
use Illuminate\Support\Facades\Auth;

class ProfileApiController extends Controller
{
    protected UserContract $service;

    public function __construct(UserContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $user = Auth::guard('api')->user();
        return WebResponseUtils::response($user);
    }
}
