<?php

namespace DigitFab\Core\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use DigitFab\Core\Classes\InlineStyles\Styles;

class InlineStyles extends ComponentBase
{
    protected $stylesProvider;

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);

        $this->stylesProvider = new Styles();
    }

    public function componentDetails()
    {
        return [
            'name'        => 'digitfab.core::lang.components.inlineStyles.name',
            'description' => 'digitfab.core::lang.components.inlineStyles.desc'
        ];
    }

    public function getStyles() {
        return $this->stylesProvider->getStyles();
    }
}