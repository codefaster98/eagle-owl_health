<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        header('Access-Control-Allow-Origin', '*');
        header('Access-Control-Allow-Methods ', "*");
        header('Access-Control-Allow-Headers', ' Origin, Content-Type, Accept, Authorization, X-Request-With');
        header('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
