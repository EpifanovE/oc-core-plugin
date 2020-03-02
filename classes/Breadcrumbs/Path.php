<?php

namespace EEV\Core\Classes\Breadcrumbs;

class Path
{
    protected $expression;

    protected $callback;

    protected $items;

    protected $matches;

    public function __construct($expression, $callback)
    {
        $this->expression = $expression;
        $this->callback = $callback;
    }

    public static function make($expression, $callback) {
        return new self($expression, $callback);
    }

    public function getExpression() {
        return $this->expression;
    }

    public function getCallback() {
        return $this->callback;
    }

    public function addItem(Item $item) {
        $this->items[] = $item;
    }

    public function getItems() {
        return $this->items;
    }

    public function setMatches($matches) {
        $this->matches = $matches;
    }

    public function getMatches() {
        return $this->matches;
    }

}