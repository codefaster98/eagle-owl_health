<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\auth\auth;

// without auth
Route::name("api.auth.")
    ->prefix("API/Auth")
    ->middleware(['api_without_auth'])
    ->controller(auth::class)
    ->group(function () {
        Route::post('/Register', 'Register')->name("Register");
        Route::post('/Login', 'Login')->name("Login");
        Route::post('/Verify', 'Verify')->name("Verify");
        Route::post('/ResetPassword', 'ResetPassword')->name("ResetPassword");

    });
// with auth
Route::name("api.auth.")
    ->prefix("API/Auth")
    ->middleware(['api', 'api_with_auth'])
    ->controller(auth::class)
    ->group(function () {
        Route::post('/Logout', 'Logout')->name("Logout");
        Route::post('/UpdateProfile', 'UpdateProfile')->name("UpdateProfile");
        Route::post('/ForgetPassword', 'ForgetPassword')->name("ForgetPassword");
        Route::post('/ValidateOTP', 'ValidateOTP')->name("ValidateOTP");


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
