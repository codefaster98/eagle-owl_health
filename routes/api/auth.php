<?php

use Illuminate\Support\Facades\Route;

// without auth
Route::name("api.auth")
    ->prefix("API/Auth")
    ->middleware(['web_without_auth'])
    ->controller(local::class)
    ->group(function () {
        Route::post('/Login', 'Login')->name("Login");
        // Route:->group(function () {
        //     });
    });
// with auth
Route::name("admin.auth")
    ->prefix("Admin/Auth")
    ->middleware(['web_with_auth'])
    ->group(function () {
        // Route::name('local.')
        //     ->controller(local::class)->group(function () {
        //         Route::get('/Login', 'ViewLogin')->name("ViewLogin");
        //         Route::post('/Login', 'Login')->name("Login");
        //     });
    });
