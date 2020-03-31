<?php

namespace EEV\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Lang;

class CallToAction extends WidgetType
{
    protected $name = self::CTA;

    protected function getFields()
    {
        return [
            'title'            => [
                'label' => Lang::get('eev.core::lang.title'),
                'span'  => 'full',
                'type'  => 'text',
                'tab'   => Lang::get('eev.core::lang.data'),
            ],
            'content' => [
                'label'          => Lang::get('eev.core::lang.content'),
                'span'           => 'full',
                'type'           => 'richeditor',
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
        ];
    }
}