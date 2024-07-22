<?php

namespace App\Http\Middlewares;

use App\Services\system\SystemApiResponseServices;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class GlobalDatabaseConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            DB::connection()->getPDO();
            return $next($request);
        } catch (\Exception $e) {
            Config::set("session.driver", "file");
            return SystemApiResponseServices::ReturnError(
                code: 9898,
                message: "Database Error",
                data: null,
            );
        }
    }
}
