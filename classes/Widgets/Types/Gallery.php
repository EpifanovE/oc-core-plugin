<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Lang;

class Gallery extends WidgetType
{
    protected $name = self::GALLERY;

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
                        'image' => [
                            'label'      => Lang::get('digitfab.core::lang.image'),
                            'type'       => 'mediafinder',
                            'mode'       => 'image',
                            'imageWidth' => 300,
                            'cssClass'   => 'col-sm-4',
                            'span'       => 'storm',
                        ],
                        'title' => [
                            'label'    => Lang::get('digitfab.core::lang.title'),
                            'cssClass' => 'col-sm-8',
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
            'cols' => [
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
            'no_gutters' => [
                'title'             => 'digitfab.core::lang.no_gutters',
                'type'              => 'checkbox',
                'group'             => 'digitfab.core::lang.elements',
                'showExternalParam' => false,
                'default'           => false,
            ],
        ];
    }


    protected function doTemplateData($componentProperties)
    {
        return [
            'rowColsClasses' => ' ' . $this->rowClasses($componentProperties),
            'cardClasses' => ' ' . $this->cardClasses($componentProperties),
        ];
    }

    protected function rowClasses($componentProperties)
    {
        $classes = [
            'row-cols-1',
        ];

        if ( ! empty($componentProperties['cols'])) {
            $classes[] = 'row-cols-lg-' . $componentProperties['cols'];
        } else {
            $classes[] = 'row-cols-lg-3';
        }

        if (!empty($componentProperties['no_gutters'])) {
            $classes[] = 'no-gutters';
        }

        return join(' ', $classes);
    }

    protected function cardClasses($componentProperties)
    {
        $classes = [];

        if (empty($componentProperties['no_gutters'])) {
            $classes[] = 'mb-4';
        }

        return join(' ', $classes);
    }
}