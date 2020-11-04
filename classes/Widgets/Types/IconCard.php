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
            'elements'         => [
                'label'    => Lang::get('digitfab.core::lang.elements'),
                'cssClass' => 'col-sm-12',
                'span'     => 'storm',
                'type'     => 'repeater',
                'tab'      => Lang::get('digitfab.core::lang.elements'),
                'prompt'   => Lang::get('digitfab.core::lang.add_element'),
                'form'     => [
                    'fields' => [
                        'title'      => [
                            'label'    => Lang::get('digitfab.core::lang.title'),
                            'cssClass' => 'col-sm-12',
                            'span'     => 'storm',
                            'type'     => 'text',
                        ],
                        'text'       => [
                            'label'    => Lang::get('digitfab.core::lang.text'),
                            'cssClass' => 'col-sm-12',
                            'span'     => 'storm',
                            'type'     => 'text',
                        ],
                        'image'      => [
                            'label'      => Lang::get('digitfab.core::lang.image'),
                            'type'       => 'mediafinder',
                            'mode'       => 'image',
                            'imageWidth' => 300,
                            'cssClass'   => 'col-sm-4',
                            'span'       => 'storm',
                        ],
                        'icon_class' => [
                            'label'    => Lang::get('digitfab.core::lang.icon_css_class'),
                            'cssClass' => 'col-sm-4',
                            'span'     => 'storm',
                            'type'     => 'text',
                        ],
                        'link'       => [
                            'label'    => Lang::get('digitfab.core::lang.link'),
                            'cssClass' => 'col-sm-4',
                            'span'     => 'storm',
                            'type'     => 'text',
                        ],
                    ],
                ],
            ],
        ];
    }

    public function getComponentProperties()
    {
        return [
            'cols'          => [
                'title'             => 'digitfab.core::lang.cols_number',
                'type'              => 'dropdown',
                'group'             => 'digitfab.core::lang.elements',
                'showExternalParam' => false,
                'default'           => '2',
                'options'           => [
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
            ],
            'card_template' => [
                'title'   => 'digitfab.core::lang.card_template',
                'type'    => 'dropdown',
                'group'   => 'digitfab.core::lang.elements',
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => 'digitfab.core::lang.horizontal',
                    'vertical'   => 'digitfab.core::lang.vertical',
                ],
            ],
        ];
    }

    protected function doTemplateData($componentProperties)
    {
        return [
            'iconCardWidthClasses' => ' ' . $this->getIconWidthClasses($componentProperties),
            'iconCardClasses'      => ' ' . $this->getIconClasses($componentProperties),
        ];
    }

    protected function getIconWidthClasses($componentProperties)
    {

        $map = [
            '2' => 'col-12 col-lg-6',
            '3' => 'col-12 col-lg-4',
            '4' => 'col-12 col-lg-3',
        ];

        if ($componentProperties['cols'] && isset($map[$componentProperties['cols']])) {
            return $map[$componentProperties['cols']];
        }

        return $map['2'];
    }

    protected function getIconClasses($componentProperties)
    {

        $classes = [];

        if ($componentProperties['card_template']) {
            $classes[] = 'icon-card_' . $componentProperties['card_template'];
        }

        return join(' ', $classes);
    }
}