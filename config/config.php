<?php

use DigitFab\Core\Models\Settings as CompanySettings;

return [
    'default_page' => 'page',
    'breadcrumbs' => [
        'show_home' => true,
        'show_last' => false,
    ],
    'forms' => [],
    'recaptcha' => [
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
        'site_key' => env('RECAPTCHA_SITE_KEY'),
    ],
    'widgets_caching' => true,
    'tags' => [
        'company_name' => CompanySettings::get('name'),
        'company_desc' => CompanySettings::get('short_desc'),
    ],
];
