<?php

namespace DigitFab\Core\Classes\Contracts;

interface Entity
{
    public function getBreadcrumbs($pageName, $controller);

    public function getTitle();

    public function getSeoTitle();

    public function getSeoDescription();

    public function getSeoKeywords();

    public function getUrl();

    public function getContent();
}
