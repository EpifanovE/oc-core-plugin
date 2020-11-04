<?php

namespace DigitFab\Core\Classes\Breadcrumbs;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class Breadcrumbs
{
    protected $config;

    protected $page;

    protected $currentPath = null;

    public function __construct($config, $page)
    {
        $this->config = $config;
        $this->page = $page;

        $this->currentPath = $this->getCurrentPath();
    }

    public function getItems()
    {
        $result = [];

        if ($root = $this->getRootItem()) {
            $result[] = $root;
        }

        $this->runCurrentCallback();

        return array_merge($result, $this->currentPath->getItems() ?? []);
    }

    protected function getRootItem()
    {
        if ($this->config['params']['home']) {
            return Item::make($this->config['params']['home'], Url::to('/'));
        }
        return null;
    }

    protected function runCurrentCallback()
    {
        $this->currentPath->getCallback()($this->currentPath, $this->page);
    }

    protected function getCurrentPath()
    {
        $uri = Request::path();

        foreach ($this->config['paths'] as $path) {
            /**
             * @var Path $path
             */
            if (preg_match($path->getExpression(), $uri, $matches)) {
                $path->setMatches($matches);
                return $path;
            }
        }

        return Path::make('#^(.+)$#', function () {
            $this->defaultCallback();
        });
    }

    protected function defaultCallback()
    {
//        $this->currentPath->addItem(Item::make($this->page->title));
    }
}