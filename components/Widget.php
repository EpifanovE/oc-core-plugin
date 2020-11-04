<?php

namespace DigitFab\Core\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use DigitFab\Core\Models\Widget as WidgetModel;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;

class Widget extends ComponentBase
{
    /**
     * @var \DigitFab\Core\Models\Widget $widget
     */
    protected $widget;

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);

        $this->widget = WidgetModel::where('id', $this->property('widget'))->active()->first();

        if (empty($this->widget)) {
            return;
        }

        $styles = $this->widget->getStyles($this->properties);

        if ( ! empty($styles)) {
            Event::listen('digitfab.core.inlineStyles', function ($inlineStyles) use ($styles) {
                return array_merge($inlineStyles, $styles);
            });
        }
    }

    public function componentDetails()
    {
        return [
            'name'        => 'digitfab.core::lang.components.widget.name',
            'description' => 'digitfab.core::lang.components.widget.desc'
        ];
    }

    public function defineProperties()
    {
        $properties = [
            'widget'    => [
                'title'             => 'digitfab.core::lang.widget',
                'description'       => '',
                'type'              => 'dropdown',
                'required'          => true,
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'adv_class' => [
                'title'             => 'digitfab.core::lang.adv_class',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'anchor_name' => [
                'title'             => 'digitfab.core::lang.anchor_name',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'id' => [
                'title'             => 'ID',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'title_tag' => [
                'title'             => 'digitfab.core::lang.title_tag',
                'description'       => '',
                'default'           => 'h2',
                'type'              => 'dropdown',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ]
            ],
            'container_width' => [
                'title'             => 'digitfab.core::lang.container_width',
                'description'       => '',
                'default'           => 'container',
                'type'              => 'dropdown',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
                'options' => [
                    'full' => 'digitfab.core::lang.full_width',
                    'container' => 'digitfab.core::lang.in_container',
                ]
            ],
        ];

        if (
            $this->widget
            && method_exists($this->widget->getTypeObject(), 'getComponentProperties')
            && is_array($this->widget->getTypeObject()->getComponentProperties())
        ) {
            return array_merge($properties, $this->widget->getTypeObject()->getComponentProperties());
        }

        return $properties;
    }

    public function getWidgetOptions()
    {
        return WidgetModel::active()->lists('name', 'id');
    }

    public function getHtml()
    {
        if (empty($this->widget)) {
            return '';
        }

        return $this->widget->getHtml($this->properties);
    }
}