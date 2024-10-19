<?php

return [
    #HYPERPAY
    // 'HYPERPAY_BASE_URL' => env('HYPERPAY_BASE_URL', "https://eu-test.oppwa.com"),
    // 'HYPERPAY_URL' => env('HYPERPAY_URL', env('HYPERPAY_BASE_URL') . "/v1/checkouts"),
    // 'HYPERPAY_TOKEN' => env('HYPERPAY_TOKEN'),
    // 'HYPERPAY_CREDIT_ID' => env('HYPERPAY_CREDIT_ID'),
    // 'HYPERPAY_MADA_ID' => env('HYPERPAY_MADA_ID'),
    // 'HYPERPAY_APPLE_ID' => env('HYPERPAY_APPLE_ID'),
    // 'HYPERPAY_CURRENCY' => env('HYPERPAY_CURRENCY', "SAR"),

    'HYPERPAY_BASE_URL' => "https://eu-test.oppwa.com",
    'HYPERPAY_URL' => "https://eu-test.oppwa.com/v1/checkouts",
    'HYPERPAY_CURRENCY' => "SAR",
    'HYPERPAY_MADA_ID' => "8a8294174d0595bb014d05d829cb01cd",
    // 'HYPERPAY_CREDIT_ID' => "8a8294174d0595bb014d05d829cb01cd",
    'HYPERPAY_TOKEN' => "OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8OVRuSlBjMm45aA==",
    // 'HYPERPAY_TOKEN' => "8a8294174d0595bb014d05d829cb01cd",

    'VERIFY_ROUTE_NAME' => "api.app.payments.CheckoutVerify",
    // 'VERIFY_ROUTE_NAME' => "api.app.membership.CheckoutVerify",
    'APP_NAME' => "SHIMA",
];
