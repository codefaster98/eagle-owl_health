<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/web/app.php',
            __DIR__ . '/../routes/web/auth.php',

        ],
        // api: [
        //     __DIR__ . '/../routes/api/app.php',
        //     __DIR__ . '/../routes/api/auth.php',
        // ],
        // commands: __DIR__ . '/../routes/console.php',
        // health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('web_with_auth', [
            // test database connection
            App\Http\Middlewares\GlobalDatabaseConnection::class,

            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            // check if admin is auth
        ]);
        $middleware->group('web_without_auth', [
            // test database connection
            App\Http\Middlewares\GlobalDatabaseConnection::class,
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            // test if admin is not auth
        ]);
        $middleware->group('api_with_auth', [
            // test database connection
            App\Http\Middlewares\GlobalDatabaseConnection::class,
            Illuminate\Routing\Middleware\SubstituteBindings::class,
            App\Http\Middlewares\JWTRequestValidate::class,
            // check if user is auth
        ]);
        $middleware->group('api_without_auth', [
            // test database connection
            App\Http\Middlewares\GlobalDatabaseConnection::class,
            Illuminate\Routing\Middleware\SubstituteBindings::class,
            // test if user is not auth
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
