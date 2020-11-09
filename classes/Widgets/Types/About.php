<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Lang;

class About extends WidgetType
{
    protected $name = self::ABOUT;

    protected function getFields() {
        return [
            'title' => [
                'label' => 'digitfab.core::lang.title',
                'span' => 'full',
                'type' => 'text',
                'tab'   => 'digitfab.core::lang.data',
            ],
            'subtitle' => [
                'label' => 'digitfab.core::lang.subtitle',
                'span' => 'full',
                'type' => 'text',
                'tab'   => 'digitfab.core::lang.data',
            ],
            'content'             => [
                'label'          => 'digitfab.core::lang.content',
                'span'           => 'full',
                'type'           => 'richeditor',
                'toolbarButtons' => 'bold|italic|underline|color',
                'tab'   => 'digitfab.core::lang.data',
            ],
            'images' => [
                'label' => 'digitfab.core::lang.images',
                'type' => 'repeater',
                'prompt' => 'digitfab.core::lang.add_image',
                'tab'   => 'digitfab.core::lang.data',
                'form' => [
                    'fields' => [
                        'src' => [
                            'label'      => 'digitfab.core::lang.image',
                            'type'       => 'mediafinder',
                            'mode'       => 'image',
                            'imageWidth' => 300,
                            'span'           => 'full',
                        ],
                        'alt' => [
                            'label' => 'Alt',
                            'span' => 'full',
                            'type' => 'text',
                        ]
                    ],
                ],
            ],
        ];
    }
}
