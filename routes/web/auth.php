<?php

use Illuminate\Support\Facades\Route;

// without auth
Route::name("admin.auth")
    ->prefix("Admin/Auth")
    ->middleware(['web_without_auth'])
    ->group(function () {
        // local auth
        // Route::name('local.')
        //     ->controller(local::class)->group(function () {
        //         Route::get('/Login', 'ViewLogin')->name("ViewLogin");
        //         Route::post('/Login', 'Login')->name("Login");
        //     });
    });
// with auth
Route::name("admin.auth")
    ->prefix("Admin/Auth")
    ->middleware(['web_with_auth'])
    ->group(function () {
        // local auth
        // Route::name('local.')
        //     ->controller(local::class)->group(function () {
        //         Route::get('/Login', 'ViewLogin')->name("ViewLogin");
        //         Route::post('/Login', 'Login')->name("Login");
        //     });
    });