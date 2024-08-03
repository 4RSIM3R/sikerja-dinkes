<?php

namespace App\Http\Middleware;

use App\Utils\WebResponseUtils;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try {
            if (!Auth::guard('api')->user()) {
                return WebResponseUtils::base(["message" => "Unauthorized Request"], "Unauthorized Request", 401);
            }
        } catch (Exception $exception) {
            if ($exception instanceof TokenInvalidException) {
                return WebResponseUtils::base(["message" => "Token Invalid"], "Token Invalid", 401);
            } else if ($exception instanceof TokenExpiredException) {
                return WebResponseUtils::base(["message" => "Token Expired"], "Token Expired", 401);
            } else {
                return WebResponseUtils::base(["message" => "Unauthorized Request"], "Unauthorized Request", 401);
            }
        }

        return $next($request);
    }
}
