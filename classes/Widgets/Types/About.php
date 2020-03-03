<?php

namespace EEV\Core\Classes\Widgets\Types;

class About extends WidgetType
{
    protected $name = self::ABOUT;

    protected function getFields() {
        return [
            'title' => [
                'label' => 'Title',
                'span' => 'full',
                'type' => 'text',
            ],
        ];
    }

}