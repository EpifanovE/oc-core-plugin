<?php

namespace DigitFab\Core\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Event;

class InlineScripts extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'digitfab.core::lang.components.inlineScripts.name',
            'description' => 'digitfab.core::lang.components.inlineScripts.desc'
        ];
    }

    public function getContent()
    {
        $default = [];

        $data = $this->prepareData(Event::fire('digitfab.core.inlineScripts', [$default]));

        return 'var App = ' . json_encode($data) . ';';
    }

    protected function prepareData($data)
    {
        $result = [];

        foreach ($data as $eventParams) {
            if (is_array($eventParams)) {
                foreach ($eventParams as $key => $value) {
                    $result[$key] = $value;
                }
            }
        }

        return $result;
    }
}
