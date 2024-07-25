<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\auth\auth;
use App\Http\Controllers\api\members\members;
use App\Http\Controllers\api\form\requestform;
use App\Http\Controllers\Api\events\eventsevents;

// without auth
Route::name("api.auth.")
    ->prefix("API/Auth")
    ->middleware(['api_without_auth'])
    ->controller(auth::class)
    ->group(function () {
        Route::post('/Register', 'Register')->name("Register");
        Route::post('/Login', 'Login')->name("Login");
        Route::post('/Verify', 'Verify')->name("Verify");
    });
// with auth
Route::name("api.auth.")
    ->prefix("API/Auth")
    ->middleware(['api', 'api_with_auth'])
    ->controller(auth::class)
    ->group(function () {
        Route::post('/Logout', 'Logout')->name("Logout");
    });

    




















// // with auth
// Route::name("admin.auth")
//     ->prefix("Admin/Auth")
//     ->middleware(['web_with_auth'])
//     ->group(function () {
//         // Route::name('local.')
//         //     ->controller(local::class)->group(function () {
//         //         Route::get('/Login', 'ViewLogin')->name("ViewLogin");
//         //         Route::post('/Login', 'Login')->name("Login");
//         //     });
//     });
