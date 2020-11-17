<?php

namespace DigitFab\Core\Components;

use Cms\Classes\ComponentBase;
use DigitFab\Core\Models\Settings;

class Core extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'digitfab.core::lang.components.core.name',
            'description' => 'digitfab.core::lang.components.core.desc'
        ];
    }

    public function onRun() {
        $this->setPageVars();
    }

    protected function setPageVars() {
        if (empty($this->page['seo_title'])) {
            $this->page['seo_title'] = 'Some title';
            $this->page['seo_title'] = Settings::get('name') . ' - ' . Settings::get('short_desc');
        }
    }
}
