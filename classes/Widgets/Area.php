<?php

namespace DigitFab\Core\Classes\Widgets;

use DigitFab\Core\Models\Widget;

class Area
{
    protected $name;

    protected $params = [];

    public function __construct($name, $params = [])
    {
        $this->name   = $name;
        $this->params = $params;
    }

    public function getWidgets()
    {
        $widgets = Widget::where('area', '=', $this->name)->active()->get();

        return $widgets->reduce(function ($carry, $item) {
            return $carry . $this->wrap($item->getHtml($this));
        }, '');
    }

    protected function wrap($html)
    {
        if (empty($this->params['wrap'])) {
            return $html;
        }

        if ($this->params['wrap'] === true) {
            return "<div>{$html}</div>";
        }

        $tag = isset($this->params['wrap']['tag']) ? $this->params['wrap']['tag'] : 'div';

        $attrs = [];

        if (isset($this->params['wrap']['class'])) {
            $attrs['class'] = $this->params['wrap']['class'];
        }

        return "<{$tag}{$this->getAttrsStr($attrs)}>$html</{$tag}>";
    }

    protected function getAttrsStr($attrs) {
        $str = '';

        if (!is_array($attrs) || count($attrs) === 0) {
            return $str;
        }

        foreach ($attrs as $key => $value) {
            $str .= " {$key}='{$value}'";
        }

        return $str;
    }
}