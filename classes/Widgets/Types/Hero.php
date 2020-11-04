<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class Hero extends WidgetType
{
    protected $name = self::HERO;

    protected function getFields()
    {
        return [
            'slides' => [
                'label' => Lang::get('digitfab.core::lang.slides'),
                'type' => 'repeater',
                'prompt' => Lang::get('digitfab.core::lang.add_slide'),
                'tab'   => Lang::get('digitfab.core::lang.data'),
                'form' => [
                    'fields' => [
                        'title'            => [
                            'label' => Lang::get('digitfab.core::lang.title'),
                            'span'  => 'storm',
                            'cssClass' => 'col-sm-12',
                            'type'  => 'text',
                        ],
                        'background_image' => [
                            'label'      => Lang::get('digitfab.core::lang.bg_image'),
                            'type'       => 'mediafinder',
                            'mode'       => 'image',
                            'imageWidth' => 300,
                            'span'           => 'storm',
                            'cssClass' => 'col-sm-4',
                        ],
                        'text'             => [
                            'label'          => Lang::get('digitfab.core::lang.text'),
                            'span'           => 'storm',
                            'cssClass' => 'col-sm-8',
                            'type'           => 'richeditor',
                            'toolbarButtons' => 'bold|italic|underline|color',
                        ],
                        'button_text'      => [
                            'label' => Lang::get('digitfab.core::lang.button_text'),
                            'cssClass' => 'col-xs-4',
                            'span'  => 'storm',
                            'type'  => 'text',
                        ],
                        'button_link'      => [
                            'label' => Lang::get('digitfab.core::lang.button_link'),
                            'cssClass' => 'col-sm-4',
                            'span'  => 'storm',
                            'type'  => 'text',
                        ],
                        'button_class'      => [
                            'label' => Lang::get('digitfab.core::lang.button_class'),
                            'cssClass' => 'col-sm-4',
                            'span'  => 'storm',
                            'type'  => 'text',
                        ],
                    ],
                ]
            ],
        ];
    }

    protected function getClasses() {
       $classes = [];

       if (count($this->data['slides']) > 1) {
           $classes[] = 'hero_slider';
           $classes[] = 'owl-carousel';
       }

       return $classes;
    }

    protected function doStyles()
    {
        $styles       = [];
        $baseMediaUrl = url(Config::get('cms.storage.media.path'));

        foreach ($this->data['slides'] as $key => $slide) {
            if ( ! empty($slide['background_image'])) {
                $styles['#hero-slide-' . $key] = [
                    'background-image' => 'url("' . $baseMediaUrl . $slide['background_image'] . '")',
                ];
            }
        }

        return $styles;
    }

}