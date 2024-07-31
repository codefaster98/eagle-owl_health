<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\members\members;
use App\Http\Controllers\Api\events\eventsevents;
use App\Http\Controllers\api\form_request\form_request;
use App\Http\Controllers\Api\memberships\memberships;

// all routes without auth
Route::name("api.app.")
    ->prefix("API/")
    ->middleware(['api_without_auth'])
    ->group(function () {
        // events routes
        Route::name("events.")
            ->prefix("Events/")
            ->controller(eventsevents::class)
            ->group(function () {
                Route::get('All', 'GetAll')->name("GetAll");
                Route::get('{code}/Details', 'Details')->name("Details");
                Route::get('GetAllData', 'GetAllData')->name("GetAllData");
            });
        // members routes
        Route::name("members.")
            ->prefix("Members/")
            ->controller(members::class)
            ->group(function () {
                Route::get('All', 'GetAll')->name("GetAll");
            });
        // memberships routes
        Route::name("memberships.")
            ->prefix("Memberships/")
            ->controller(memberships::class)
            ->group(function () {
                Route::get('All', 'GetAll')->name("GetAll");
                Route::get('{code}/Details', 'Details')->name("Details");
            });
        // form request routes
        Route::name("form_request.")
            ->prefix("Form-Request/")
            ->controller(form_request::class)
            ->group(function () {
                Route::post('Add', 'Add')->name("Add");
            });
    });
// all routes with auth

Route::name("api.app.")
    ->prefix("API/")
    ->middleware(['api_with_auth'])
    ->group(function () {
        // events routes
        Route::name("events.")
            ->prefix("Events/")
            ->controller(eventsevents::class)
            ->group(function () {
                Route::get('{code}/Details', 'Details')->name("Details");
                Route::post('GetAllWithData', 'GetAllWithData')->name("GetAllWithData");
            });
    });

