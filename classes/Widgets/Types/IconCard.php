<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class IconCard extends WidgetType
{
    protected $name = self::ICONCARD;

    protected function getFields()
    {
        return [
            'title'         => [
                'label'    => 'digitfab.core::lang.title',
                'cssClass' => 'col-sm-12',
                'span'     => 'storm',
                'type'     => 'text',
                'tab'      => 'digitfab.core::lang.data',
            ],
            'subtitle'      => [
                'label'    => 'digitfab.core::lang.subtitle',
                'cssClass' => 'col-sm-12',
                'span'     => 'storm',
                'type'     => 'text',
                'tab'      => 'digitfab.core::lang.data',
            ],
            'elements'      => [
                'label'    => 'digitfab.core::lang.elements',
                'cssClass' => 'col-sm-12',
                'span'     => 'storm',
                'type'     => 'repeater',
                'tab'      => 'digitfab.core::lang.elements',
                'prompt'   => 'digitfab.core::lang.add_element',
                'form'     => [
                    'fields' => [
                        'title'      => [
                            'label'    => 'digitfab.core::lang.title',
                            'cssClass' => 'col-sm-12',
                            'span'     => 'storm',
                            'type'     => 'text',
                        ],
                        'text'       => [
                            'label'    => 'digitfab.core::lang.text',
                            'cssClass' => 'col-sm-12',
                            'span'     => 'storm',
                            'type'     => 'text',
                        ],
                        'image'      => [
                            'label'      => 'digitfab.core::lang.image',
                            'type'       => 'mediafinder',
                            'mode'       => 'image',
                            'imageWidth' => 300,
                            'cssClass'   => 'col-sm-4',
                            'span'       => 'storm',
                        ],
                        'icon_class' => [
                            'label'    => 'digitfab.core::lang.icon_css_class',
                            'cssClass' => 'col-sm-4',
                            'span'     => 'storm',
                            'type'     => 'text',
                        ],
                        'link'       => [
                            'label'    => 'digitfab.core::lang.link',
                            'cssClass' => 'col-sm-4',
                            'span'     => 'storm',
                            'type'     => 'text',
                        ],
                    ],
                ],
            ],
            'cols'          => [
                'label'             => 'digitfab.core::lang.cols_number',
                'type'              => 'dropdown',
                'tab'               => 'digitfab.core::lang.adv_settings',
                'showExternalParam' => false,
                'default'           => '2',
                'options'           => [
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
            ],
            'card_template' => [
                'label'   => 'digitfab.core::lang.card_template',
                'type'    => 'dropdown',
                'tab'     => 'digitfab.core::lang.adv_settings',
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => 'digitfab.core::lang.horizontal',
                    'vertical'   => 'digitfab.core::lang.vertical',
                ],
            ],
        ];
    }

    protected function doTemplateData()
    {
        return [
            'iconCardWidthClasses' => ' ' . $this->getIconWidthClasses(),
            'iconCardClasses'      => ' ' . $this->getIconClasses(),
        ];
    }

    protected function getIconWidthClasses()
    {

        $map = [
            '2' => 'Grid__Col_12 Grid__Col_md_6',
            '3' => 'Grid__Col_12 Grid__Col_md_4',
            '4' => 'Grid__Col_12 Grid__Col_md_3',
        ];

        if ( ! empty($this->data['cols']) && isset($map[$this->data['cols']])) {
            return $map[$this->data['cols']];
        }

        return $map['2'];
    }

    protected function getIconClasses()
    {

        $classes = [];

        if (empty($this->data['card_template'])) {
            return '';
        }

        $classes[] = "ImageCard_{$this->data['card_template']}";

        return join(' ', $classes);
    }
}
