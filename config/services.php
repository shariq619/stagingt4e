<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'stripe' => [
        'key' => env('STRIPE_KEY'), // Load from .env
        'secret' => env('STRIPE_SECRET'),
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'paypal' => [
        'client_id' => env('ASLJxakQ3tDRjMUTE90TYOWGAu0kcBpFxzVWvxGkTrUFJ1LQnuIVN3ruZgMOHuYLqRQoz0dDbjZ27oId'),
        'secret' => env('EF8bZHu78v3cu49HGYBkc4Qa54IVTZRGrk1Vn23lq565sKP7ZQOfK7sKuHQ0sZ9eDiqUBZ1dMa0wIq'),
        'mode' => env('PAYPAL_MODE', 'sandbox'),
    ],
    'nocaptcha' => [
        'sitekey' => env('NOCAPTCHA_SITEKEY'),
        'secret' => env('NOCAPTCHA_SECRET'),
    ],

];
