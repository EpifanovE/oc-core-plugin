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
            'title'            => [
                'label'    => 'digitfab.core::lang.title',
                'span'     => 'storm',
                'cssClass' => 'col-xs-12',
                'type'     => 'text',
                'tab'      => 'digitfab.core::lang.content',
            ],
            'background_image' => [
                'label'      => 'digitfab.core::lang.bg_image',
                'type'       => 'mediafinder',
                'mode'       => 'image',
                'imageWidth' => 300,
                'span'       => 'storm',
                'cssClass'   => 'col-xs-12',
                'tab'      => 'digitfab.core::lang.content',
            ],
            'text'             => [
                'label'          => 'digitfab.core::lang.text',
                'span'           => 'storm',
                'cssClass'       => 'col-xs-12',
                'type'           => 'richeditor',
                'toolbarButtons' => 'bold|italic|underline|color',
                'tab'      => 'digitfab.core::lang.content',
            ],
            'button_text'      => [
                'label'    => 'digitfab.core::lang.button_text',
                'cssClass' => 'col-xs-12',
                'span'     => 'storm',
                'type'     => 'text',
                'tab'      => 'digitfab.core::lang.content',
            ],
            'full_height' => [
                'label'    => 'digitfab.core::lang.full_height',
                'cssClass' => 'col-xs-12',
                'span'     => 'storm',
                'type'     => 'switch',
                'tab'      => 'digitfab.core::lang.adv_settings',
            ],
        ];
    }

    protected function doStyles() : array
    {
        $styles       = [];
        $baseMediaUrl = url(Config::get('cms.storage.media.path'));

        if (!empty($this->data['background_image'])) {
            $styles['background-image'] = 'url("' . $baseMediaUrl . $this->data['background_image'] . '")';
        }

        return $styles;
    }

    protected function doClasses() {
        if (!empty($this->data['full_height'])) {
            return 'Hero_fullHeight';
        }
    }
}
