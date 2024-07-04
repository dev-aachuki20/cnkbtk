<?php

return [
    'mode' => env('PAYPAL_MODE', 'sandbox'),
    'sandbox' => [
        'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
    ],
    'live' => [
        'client_id' => env('PAYPAL_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_SECRET', ''),
    ],
    'payment_action' => 'Pay',
    'currency' => env('PAYPAL_CURRENCY', 'USD'),
    'validate_ssl' => env('PAYPAL_VALIDATE_SSL', true),
];
