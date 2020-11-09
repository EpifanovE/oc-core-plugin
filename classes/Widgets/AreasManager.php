<?php

namespace DigitFab\Core\Classes\Widgets;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;
use mysql_xdevapi\Exception;

class AreasManager
{
    protected $areas = [];

    public function __construct()
    {
        $this->areas = Event::fire('digitfab.core.areas', ['areas' => []])[0];
    }

    public function getArea($name): Area
    {
        if ( ! array_key_exists($name, $this->areas)) {
            throw new Exception('Area "' . $name . '" doesn\'t exists');
        }

        return new Area($name, $this->areas[$name]);
    }

    public function getAreasList(): array
    {
        if (count($this->areas) === 0) {
            throw new Exception('Areas list is empty.');
        }

        $result = [];

        foreach ($this->areas as $name => $params) {
            if ( ! empty($params['title'])) {
                $result[$name] = $params['title'];
            } else {
                $result[$name] = $result[$name];
            }
        }

        return $result;
    }

    public function getAreaLabel($name) {
        if ( ! array_key_exists($name, $this->areas)) {
            throw new Exception('Area "' . $name . '" doesn\'t exists');
        }

        return Lang::get("digitfab.theme1::lang.areas.{$name}");
    }
}
