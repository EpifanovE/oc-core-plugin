<?php

namespace DigitFab\Core\Classes\Breadcrumbs;

class Item
{
    public $label;

    public $url = '';

    public $isHome = false;

    public $isLast = false;

    public function __construct($label, $url = '')
    {
        $this->label = $label;
        $this->url = $url;
    }

    public static function make($label, $url = '')
    {
        return new self($label, $url);
    }

    public function setIsHome()
    {
        $this->isHome = true;
        return $this;
    }

    public function setIsLast()
    {
        $this->isLast = true;
        return $this;
    }

}
