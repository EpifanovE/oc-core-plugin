<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Lang;

class About extends WidgetType
{
    protected $name = self::ABOUT;

    protected function getFields() {
        return [
            'title' => [
                'label' => Lang::get('digitfab.core::lang.title'),
                'span' => 'full',
                'type' => 'text',
                'tab'   => Lang::get('digitfab.core::lang.data'),
            ],
            'desc'             => [
                'label'          => Lang::get('digitfab.core::lang.text'),
                'span'           => 'full',
                'type'           => 'richeditor',
                'toolbarButtons' => 'bold|italic|underline|color',
                'tab'   => Lang::get('digitfab.core::lang.data'),
            ],
            'button_text'      => [
                'label' => Lang::get('digitfab.core::lang.button_text'),
                'cssClass' => 'col-xs-4',
                'span'  => 'storm',
                'type'  => 'text',
                'tab'   => Lang::get('digitfab.core::lang.data'),
            ],
            'button_link'      => [
                'label' => Lang::get('digitfab.core::lang.button_link'),
                'cssClass' => 'col-sm-4',
                'span'  => 'storm',
                'type'  => 'text',
                'tab'   => Lang::get('digitfab.core::lang.data'),
            ],
            'button_class'      => [
                'label' => Lang::get('digitfab.core::lang.button_class'),
                'cssClass' => 'col-sm-4',
                'span'  => 'storm',
                'type'  => 'text',
                'tab'   => Lang::get('digitfab.core::lang.data'),
            ],
            'images' => [
                'label' => Lang::get('digitfab.core::lang.images'),
                'type' => 'repeater',
                'prompt' => Lang::get('digitfab.core::lang.add_image'),
                'tab'   => Lang::get('digitfab.core::lang.data'),
                'form' => [
                    'fields' => [
                        'image' => [
                            'label'      => Lang::get('digitfab.core::lang.image'),
                            'type'       => 'mediafinder',
                            'mode'       => 'image',
                            'imageWidth' => 300,
                            'span'           => 'full',
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function doTemplateData() {
        return [];
    }

}