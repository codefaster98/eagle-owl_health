<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\auth\auth;
use App\Http\Controllers\api\members\members;
use App\Http\Controllers\api\form\requestform;
use App\Http\Controllers\Api\events\eventsevents;
use App\Http\Controllers\Api\memberships\memberships;

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
    ->middleware(['api_with_auth'])
    ->controller(auth::class)
    ->group(function () {
        Route::post('/Logout', 'Logout')->name("Logout");
    });
Route::name("api.auth.")
    ->prefix("API/Users")
    ->middleware(['api_without_auth'])
    ->controller(eventsevents::class)
    ->group(function () {
        Route::get('/getAllEvents', 'getAllEvents')->name("all");
        Route::get('/show/{id}', 'show')->name("showEvents");
    });

Route::name("api.auth.")
    ->prefix("API/Users")
    ->middleware(['api_without_auth'])
    ->controller(requestform::class)
    ->group(function () {
        Route::post('/form', 'form')->name("request_form");
    });
    Route::name("api.auth.")
    ->prefix("API/Users")
    ->middleware(['api_without_auth'])
    ->controller(members::class)
    ->group(function () {
        Route::get('/getMembers', 'getMembers')->name("getMembers");
    });
    Route::name("api.auth.")
    ->prefix("API/Users")
    ->middleware(['api_without_auth'])
    ->controller(memberships::class)
    ->group(function () {
        Route::get('/memberShips', 'memberShips')->name("memberShips");
        Route::get('/showM/{id}', 'show')->name("showMemberSgips");

    });
