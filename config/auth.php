<?php

return [


    /**
     * /////// ADMINS /////////
     * guard = admin
     * provider = admins
     * model  = 
     */
    'defaults' => [
        'guard' => "api",
        'passwords' => "users",
    ],

    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' =>  App\Models\User::class,
        ],
        'users' => [
            'driver' => 'eloquent',
            'model' =>  App\Models\User::class,
        ],


    ],



    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],


    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
