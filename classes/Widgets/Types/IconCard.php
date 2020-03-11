<?php

namespace EEV\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Lang;

class IconCard extends WidgetType
{
    protected $name = self::ABOUT;

    protected function getFields()
    {
        return [
            'title' => [
                'label' => Lang::get('eev.core::lang.title'),
                'span' => 'full',
                'type' => 'text',
                'tab'   => Lang::get('eev.core::lang.data'),
            ],
            'subtitle'             => [
                'label'          => Lang::get('eev.core::lang.subtitle'),
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
            'cols' => [
                'label' => Lang::get('eev.core::lang.cols_number'),
                'cssClass' => 'col-sm-12',
                'span'  => 'storm',
                'type'  => 'dropdown',
                'tab'   => Lang::get('eev.core::lang.elements'),
                'options' => [
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
            ],
            'elements' => [
                'label' => Lang::get('eev.core::lang.elements'),
                'cssClass' => 'col-sm-12',
                'span'  => 'storm',
                'type'  => 'repeater',
                'tab'   => Lang::get('eev.core::lang.elements'),
                'prompt' => Lang::get('eev.core::lang.add_element'),
                'form' => [
                    'fields' => [
                        'title' => [
                            'label' => Lang::get('eev.core::lang.title'),
                            'cssClass' => 'col-sm-12',
                            'span'  => 'storm',
                            'type' => 'text',
                        ],
                        'text' => [
                            'label' => Lang::get('eev.core::lang.text'),
                            'cssClass' => 'col-sm-12',
                            'span'  => 'storm',
                            'type' => 'text',
                        ],
                        'image' => [
                            'label'      => Lang::get('eev.core::lang.image'),
                            'type'       => 'mediafinder',
                            'mode'       => 'image',
                            'imageWidth' => 300,
                            'cssClass' => 'col-sm-6',
                            'span'  => 'storm',
                        ],
                        'icon_class' => [
                            'label' => Lang::get('eev.core::lang.icon_css_class'),
                            'cssClass' => 'col-sm-6',
                            'span'  => 'storm',
                            'type' => 'text',
                        ],
                    ],
                ],
            ],
        ];
    }
}