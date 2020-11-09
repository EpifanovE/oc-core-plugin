<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Lang;

class Code extends WidgetType
{
    protected $name = self::CODE;

    protected function getFields()
    {
        return [
            'content'           => [
                'label'       => 'digitfab.core::lang.content',
                'description' => '',
                'default'     => '',
                'type'        => 'codeeditor',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-12',
                'tab'         => 'digitfab.core::lang.content',
            ],
        ];
    }
}
