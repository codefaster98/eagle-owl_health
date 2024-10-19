<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\members\members;
use App\Http\Controllers\Api\Payment\payments;
use App\Http\Controllers\Api\events\eventsevents;
use App\Http\Controllers\Api\Payment\EventsCheckout;
use App\Http\Controllers\Api\memberships\memberships;
use App\Http\Controllers\Api\form_request\contact_form;
use App\Http\Controllers\Api\form_request\form_request;
use App\Http\Controllers\Api\Payment\MemberShipCheckout;
use App\Http\Controllers\Api\form_request\form_volunteer;

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
                Route::post('GetAllWithData', 'GetAllWithData')->name("GetAllWithData");
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
        // form  Contact request routes

        Route::name("form_contact.")
            ->prefix("Form-Contact/")
            ->controller(contact_form::class)
            ->group(function () {
                Route::post('Contact', 'Contact')->name("Contact");
            });
             // form Volunteer form routes

        Route::name("form_Volunteer.")
        ->prefix("Form-Volunteer/")
        ->controller(form_volunteer::class)
        ->group(function () {
            Route::post('Volunteer', 'Volunteer')->name("Volunteer");
        });
        Route::name("payments.")
        ->prefix("Payments/")
        ->controller(EventsCheckout::class)
        ->group(function () {
        Route::get('Checkout-Verify/{payment?}', 'CheckoutVerify')->name("CheckoutVerify");
        });

        Route::name("membership.")
        ->prefix("MemberShip/")
        ->controller(MemberShipCheckout::class)
        ->group(function () {
        Route::get('Checkout-Verify/{payment?}', 'CheckoutVerify')->name("CheckoutVerify");
        });

    });

    Route::name("api.app.")
    ->prefix("API/")
    ->middleware(['api_with_auth'])
    ->group(function () {
        // events routes
        Route::name("payments.")
            ->prefix("Payments/")
            ->controller(EventsCheckout::class)
            ->group(function () {
            Route::post('Checkout', 'Checkout')->name("Checkout");
        });
        // memberships routes
        Route::name("MemberShip.")
            ->prefix("MemberShip/")
            ->controller(MemberShipCheckout::class)
            ->group(function () {
            Route::post('Checkout', 'Checkout')->name("Checkout");
        });
    });
