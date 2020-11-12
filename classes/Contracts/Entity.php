<?php

namespace DigitFab\Core\Classes\Contracts;

interface Entity
{
    public function getBreadcrumbs();

    public function getTitle();

    public function getSeoTitle();

    public function getSeoDescription();

    public function getSeoKeywords();

    public function getUrl();
}
