<?php

namespace EEV\Core\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use EEV\Core\Models\Widget as WidgetModel;
use Illuminate\Support\Facades\Event;

class Widget extends ComponentBase
{
    /**
     * @var \EEV\Core\Models\Widget $widget
     */
    protected $widget;

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);

        $this->widget = WidgetModel::where('id', $this->property('widget'))->active()->first();

        if (empty($this->widget)) {
            return;
        }

        $styles = $this->widget->getStyles();

        if ( ! empty($styles)) {
            Event::listen('eev.core.inlineStyles', function ($inlineStyles) use ($styles) {
                return array_merge($inlineStyles, $styles);
            });
        }
    }

    public function componentDetails()
    {
        return [
            'name'        => 'eev.core::lang.components.widget.name',
            'description' => 'eev.core::lang.components.widget.desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'widget'    => [
                'title'             => 'eev.core::lang.widget',
                'description'       => '',
                'type'              => 'dropdown',
                'required'          => true,
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.params',
            ],
            'adv_class' => [
                'title'             => 'eev.core::lang.adv_class',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.params',
            ],
        ];
    }

    public function getWidgetOptions()
    {
        $options = WidgetModel::active()->lists('name', 'id');

        return $options;
    }

    public function getHtml()
    {
        if (empty($this->widget)) {
            return '';
        }

        return $this->widget->getHtml();
    }
}