<?php

namespace EEV\Core\Classes\InlineStyles;

use Illuminate\Support\Facades\Event;

class Styles
{
    protected $styles;

    public function __construct()
    {
        $styles = [];

        $styles = $this->getArray(Event::fire('eev.core.inlineStyles', [$styles]));

        $this->styles = $styles;
    }

    public function getStyles()
    {
        return $this->getString();
    }

    public function getString()
    {
        if (empty($this->styles)) {
            return '';
        }

        $result = '';
        foreach ($this->styles as $selector => $styles) {

            $result .= $selector . '{';

            foreach ($styles as $key => $value) {
                $result .= $key . ':' . $value . ';';
            }

            $result .= '}';
        }

        return $result;
    }

    protected function getArray($array)
    {
        if (empty($array)) {
            return [];
        }

        $result = [];

        foreach ($array as $item) {

            if ( ! is_array($item)) {
                continue;
            }

            $result = array_merge($result, $item);
        }

        return $result;
    }
}