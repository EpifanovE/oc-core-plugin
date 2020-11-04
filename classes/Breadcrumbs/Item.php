<?php

namespace DigitFab\Core\Classes\Breadcrumbs;

class Item
{
    protected $label;

    protected $url = '';

    public function __construct($label, $url = '')
    {
        $this->label = $label;
        $this->url = $url;
    }

    public static function make($label, $url = '') {
        return new self($label, $url);
    }

    public function getLabel() {
        return $this->label;
    }

    public function getUrl() {
        return $this->url;
    }

}