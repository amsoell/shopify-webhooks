<?php

return [
    'logging' => [
        'driver' => env('SHOPIFY_WEBHOOKS_LOGGING_DRIVER', null),
        'level' => 'info',
    ],
    'signature' => env('SHOPIFY_WEBHOOKS_SIGNATURE'),
];
