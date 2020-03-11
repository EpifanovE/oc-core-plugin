<?php

namespace EEV\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Lang;

class About extends WidgetType
{
    protected $name = self::ABOUT;

    protected function getFields() {
        return [
            'title' => [
                'label' => Lang::get('eev.core::lang.title'),
                'span' => 'full',
                'type' => 'text',
                'tab'   => Lang::get('eev.core::lang.data'),
            ],
            'desc'             => [
                'label'          => Lang::get('eev.core::lang.text'),
                'span'           => 'full',
                'type'           => 'richeditor',
                'toolbarButtons' => 'bold|italic|underline|color',
                'tab'   => Lang::get('eev.core::lang.data'),
            ],
            'button_text'      => [
                'label' => Lang::get('eev.core::lang.button_text'),
                'cssClass' => 'col-xs-4',
                'span'  => 'storm',
                'type'  => 'text',
                'tab'   => Lang::get('eev.core::lang.data'),
            ],
            'button_link'      => [
                'label' => Lang::get('eev.core::lang.button_link'),
                'cssClass' => 'col-sm-4',
                'span'  => 'storm',
                'type'  => 'text',
                'tab'   => Lang::get('eev.core::lang.data'),
            ],
            'button_class'      => [
                'label' => Lang::get('eev.core::lang.button_class'),
                'cssClass' => 'col-sm-4',
                'span'  => 'storm',
                'type'  => 'text',
                'tab'   => Lang::get('eev.core::lang.data'),
            ],
            'images' => [
                'label' => Lang::get('eev.core::lang.images'),
                'type' => 'repeater',
                'prompt' => Lang::get('eev.core::lang.add_image'),
                'tab'   => Lang::get('eev.core::lang.data'),
                'form' => [
                    'fields' => [
                        'image' => [
                            'label'      => Lang::get('eev.core::lang.image'),
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