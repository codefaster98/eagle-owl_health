<?php

use App\Http\Controllers\Api\events\eventsevents;
use App\Http\Controllers\api\form\requestform;
use App\Http\Controllers\api\members\members;
use Illuminate\Support\Facades\Route;

// with auth
Route::name("api.auth.")
    ->prefix("API/Users")
    ->middleware(['api_with_auth'])
    ->controller(eventsevents::class)
    ->group(function () {
        Route::get('/getAllEvents', 'getAllEvents')->name("getAllEvents");
        Route::get('/show/{id}', 'show')->name("show");
    });



Route::name("api.auth.")
    ->prefix("API/Users")
    ->middleware(['api_with_auth'])
    ->controller(requestform::class)
    ->group(function () {
        Route::post('/form', 'form')->name("form");
    });


Route::name("api.auth.")
    ->prefix("API/Users")
    ->middleware(['api_with_auth'])
    ->controller(members::class)
    ->group(function () {
        Route::get('/getMembers', 'getMembers')->name("getMembers");
    });
