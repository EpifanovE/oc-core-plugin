<?php

return [
    'breadcrumbs' => [
        'paths' => [],
        'params' => [
            'home' => 'Главная',
        ],
    ],
    'forms' => [],
    'recaptcha' => [
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
        'site_key'   => env('RECAPTCHA_SITE_KEY'),
    ],
    'widgets_caching' => true,
];
