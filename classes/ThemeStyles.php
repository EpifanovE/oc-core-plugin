<?php

namespace EEV\Core\Classes;

use Cms\Classes\Theme;
use Illuminate\Support\Facades\Config;

class ThemeStyles
{
    protected $styles = [];

    public function __construct()
    {
        $theme = Theme::getActiveTheme();
        $baseMediaUrl = url(Config::get('cms.storage.media.path'));

        if ( ! empty($theme->page_title_bg_image)) {
            $this->styles['.page-header:after'] = [
                'background' => 'url("' . $baseMediaUrl . $theme->page_title_bg_image . '")',
            ];
        }
    }

    public function getStyles()
    {
        return $this->styles;
    }

}