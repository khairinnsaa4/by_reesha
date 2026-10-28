<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi kredensial Merchant ID, Client Key, Server Key untuk
    | integrasi Payment Gateway Midtrans (Core API QRIS & Snap).
    |
    */

    'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
    'client_key'  => env('MIDTRANS_CLIENT_KEY'),
    'server_key'  => env('MIDTRANS_SERVER_KEY'),

    'is_production' => (bool) env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized'  => true,
    'is_3ds'        => true,

    'api_url' => env('MIDTRANS_IS_PRODUCTION', false)
        ? 'https://api.midtrans.com'
        : 'https://api.sandbox.midtrans.com',
];
