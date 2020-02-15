<?php

namespace EEV\Core;

use Illuminate\Support\Facades\Event;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function boot()
    {
        Event::listen('cms.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addCss('/plugins/eev/core/assets/css/core.min.css');
        });

        Event::listen('cms.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addJs('/plugins/eev/core/assets/js/core.min.js');
        });

        Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addCss('/plugins/eev/core/assets/css/admin.min.css');
        });

        parent::boot();
    }

}