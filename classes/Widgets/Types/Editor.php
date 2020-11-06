<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Lang;

class Editor extends WidgetType
{
    protected $name = self::EDITOR;

    protected function getFields()
    {
        return [
            'content'           => [
                'label'       => 'digitfab.core::lang.content',
                'description' => '',
                'default'     => '',
                'type'        => 'codeeditor',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.content'),
            ],
        ];
    }

}