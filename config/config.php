<?php

use EEV\Core\Classes\Breadcrumbs\Path;

return [
    'breadcrumbs' => [
        'paths' => [
            Path::make('#^uslugi$#', function (Path $path, $page) {
                $path->addItem(Item::make('Услуги'));
            }),
        ],
        'params' => [
            'home' => 'Главная',
        ],
    ],
    'forms' => [],
    'recaptcha' => [
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
        'site_key'   => env('RECAPTCHA_SITE_KEY'),
    ],
];