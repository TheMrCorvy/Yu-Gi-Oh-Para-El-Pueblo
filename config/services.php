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
    'sendgrid' => [
        'api_key' => env('SENDGRID_API_KEY'),
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'mercadopago' => [
        'base_uri' => env('MERCADOPAGO_BASE_URI'),
        // 'key' => 'APP_USR-4c1795ac-213f-4365-b751-903f989a0ef4',
        // 'secret' => 'APP_USR-5335838603290674-042002-0ddc6aac78f1c0ec486ae97c5d091ba4-269521043',
        'key' => 'TEST-031d301c-1fa7-43d2-bfc6-459d6b12c5d7',
        'secret' => 'TEST-7120844547621159-041414-93e238c345230480239bef250d78f2b5-143014265',
        'base_currency' => 'ars',
        // 'class' => App\Services\MercadoPagoService::class,
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
