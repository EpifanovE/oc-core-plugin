<?php

namespace EEV\Core;

use EEV\Core\Classes\ThemeStyles;
use EEV\Core\Components\Breadcrumbs;
use EEV\Core\Components\InlineStyles;
use Illuminate\Support\Facades\Event;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function boot()
    {
        Event::listen('cms.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addCss('/plugins/eev/core/assets/css/core.min.css');
            $controller->addJs('/plugins/eev/core/assets/js/core.min.js');
        });

        Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addCss('/plugins/eev/core/assets/css/admin.min.css');
        });

        Event::listen('eev.core.inlineStyles', function ($styles) {
            $themeStylesManager = new ThemeStyles();
            return array_merge($styles, $themeStylesManager->getStyles());
        });

        parent::boot();
    }

    public function registerComponents()
    {
        return [
            InlineStyles::class => 'inlineStyles',
            Breadcrumbs::class => 'breadcrumbs',
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'trans' => [$this, 'getTranslate']
            ],
        ];
    }

    public function getTranslate($message, $variables = [])
    {
        return\Lang::get($message, $variables);
    }

}