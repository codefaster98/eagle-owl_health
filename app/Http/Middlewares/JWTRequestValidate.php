<?php

namespace App\Http\Middlewares;

use App\Services\ApiResponseServices;
use App\Services\system\SystemApiResponseServices;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            // dd($user);
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return SystemApiResponseServices::ReturnError(9802, [], __("auth.TokenIsInvalid"));
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return SystemApiResponseServices::ReturnError(9803, [], __("auth.TokenIsExpired"));
            } else {
                return SystemApiResponseServices::ReturnError(9804, [], __("auth.AuthorizationTokenNotFound"));
            }
        }
        return $next($request);
    }
}
