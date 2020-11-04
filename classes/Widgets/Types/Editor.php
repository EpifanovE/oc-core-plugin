<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Lang;

class Editor extends WidgetType
{
    protected $name = self::EDITOR;

    protected function getFields()
    {
        return [
            'title'            => [
                'label' => Lang::get('digitfab.core::lang.title'),
                'span'  => 'full',
                'type'  => 'text',
                'tab'   => Lang::get('digitfab.core::lang.data'),
            ],
            'subtitle'         => [
                'label'          => Lang::get('digitfab.core::lang.subtitle'),
                'span'           => 'full',
                'type'           => 'richeditor',
                'toolbarButtons' => 'bold|italic|underline|color',
                'tab'            => Lang::get('digitfab.core::lang.data'),
            ],
            'content' => [
                'label'          => Lang::get('digitfab.core::lang.content'),
                'span'           => 'full',
                'type'           => 'richeditor',
                'tab'            => Lang::get('digitfab.core::lang.data'),
            ],
            'button_text'      => [
                'label'    => Lang::get('digitfab.core::lang.button_text'),
                'cssClass' => 'col-xs-4',
                'span'     => 'storm',
                'type'     => 'text',
                'tab'      => Lang::get('digitfab.core::lang.data'),
            ],
            'button_link'      => [
                'label'    => Lang::get('digitfab.core::lang.button_link'),
                'cssClass' => 'col-sm-4',
                'span'     => 'storm',
                'type'     => 'text',
                'tab'      => Lang::get('digitfab.core::lang.data'),
            ],
            'button_class'     => [
                'label'    => Lang::get('digitfab.core::lang.button_class'),
                'cssClass' => 'col-sm-4',
                'span'     => 'storm',
                'type'     => 'text',
                'tab'      => Lang::get('digitfab.core::lang.data'),
            ],
            'background_image' => [
                'label'      => Lang::get('digitfab.core::lang.bg_image'),
                'type'       => 'mediafinder',
                'mode'       => 'image',
                'imageWidth' => 300,
                'span'       => 'storm',
                'cssClass'   => 'col-sm-12',
                'tab'        => Lang::get('digitfab.core::lang.data'),
            ],
        ];
    }

}