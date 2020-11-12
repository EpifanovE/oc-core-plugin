<?php

return [
    'default_page' => 'page',
    'breadcrumbs' => [
        'show_home' => true,
        'show_last' => true,
    ],
    'forms' => [],
    'recaptcha' => [
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
        'site_key' => env('RECAPTCHA_SITE_KEY'),
    ],
    'widgets_caching' => true,
];
