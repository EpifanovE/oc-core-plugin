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
];