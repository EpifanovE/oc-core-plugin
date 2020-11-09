<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class CallToAction extends WidgetType
{
    protected $name = self::CTA;

    protected function getFields()
    {
        return [
            'title'            => [
                'label' => Lang::get('digitfab.core::lang.title'),
                'span'  => 'full',
                'type'  => 'text',
                'tab'   => Lang::get('digitfab.core::lang.data'),
            ],
            'content' => [
                'label'          => Lang::get('digitfab.core::lang.content'),
                'span'           => 'full',
                'type'           => 'richeditor',
                'tab'            => Lang::get('digitfab.core::lang.data'),
            ],
            'button_text'      => [
                'label'    => Lang::get('digitfab.core::lang.button_text'),
                'cssClass' => 'col-xs-4',
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
}
