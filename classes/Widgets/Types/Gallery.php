<?php

namespace EEV\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Lang;

class Gallery extends WidgetType
{
    protected $name = self::GALLERY;

    protected function getFields()
    {
        return [
            'title'            => [
                'label' => Lang::get('eev.core::lang.title'),
                'span'  => 'full',
                'type'  => 'text',
                'tab'   => Lang::get('eev.core::lang.data'),
            ],
            'subtitle'         => [
                'label'          => Lang::get('eev.core::lang.subtitle'),
                'span'           => 'full',
                'type'           => 'richeditor',
                'toolbarButtons' => 'bold|italic|underline|color',
                'tab'            => Lang::get('eev.core::lang.data'),
            ],
            'button_text'      => [
                'label'    => Lang::get('eev.core::lang.button_text'),
                'cssClass' => 'col-xs-4',
                'span'     => 'storm',
                'type'     => 'text',
                'tab'      => Lang::get('eev.core::lang.data'),
            ],
            'button_link'      => [
                'label'    => Lang::get('eev.core::lang.button_link'),
                'cssClass' => 'col-sm-4',
                'span'     => 'storm',
                'type'     => 'text',
                'tab'      => Lang::get('eev.core::lang.data'),
            ],
            'button_class'     => [
                'label'    => Lang::get('eev.core::lang.button_class'),
                'cssClass' => 'col-sm-4',
                'span'     => 'storm',
                'type'     => 'text',
                'tab'      => Lang::get('eev.core::lang.data'),
            ],
            'background_image' => [
                'label'      => Lang::get('eev.core::lang.bg_image'),
                'type'       => 'mediafinder',
                'mode'       => 'image',
                'imageWidth' => 300,
                'span'       => 'storm',
                'cssClass'   => 'col-sm-12',
                'tab'        => Lang::get('eev.core::lang.data'),
            ],
            'elements'         => [
                'label'    => Lang::get('eev.core::lang.elements'),
                'cssClass' => 'col-sm-12',
                'span'     => 'storm',
                'type'     => 'repeater',
                'tab'      => Lang::get('eev.core::lang.elements'),
                'prompt'   => Lang::get('eev.core::lang.add_element'),
                'form'     => [
                    'fields' => [
                        'image'      => [
                            'label'      => Lang::get('eev.core::lang.image'),
                            'type'       => 'mediafinder',
                            'mode'       => 'image',
                            'imageWidth' => 300,
                            'cssClass'   => 'col-sm-4',
                            'span'       => 'storm',
                        ],
                        'title'      => [
                            'label'    => Lang::get('eev.core::lang.title'),
                            'cssClass' => 'col-sm-8',
                            'span'     => 'storm',
                            'type'     => 'text',
                        ],
                    ],
                ],
            ],
        ];
    }
}