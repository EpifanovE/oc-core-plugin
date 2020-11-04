<?php

namespace DigitFab\Core\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Config;

class Breadcrumbs extends ComponentBase
{
    /**
     * @var \DigitFab\Core\Classes\Breadcrumbs\Breadcrumbs
     */
    protected $breadcrumbsManager;

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);
    }

    public function componentDetails()
    {
        return [
            'name' => 'digitfab.core::lang.components.breadcrumbs.name',
            'description' => 'digitfab.core::lang.components.breadcrumbs.desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'adv_class' => [
                'title' => 'digitfab.core::lang.adv_class',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
                'group' => 'digitfab.core::lang.params',
            ],
        ];
    }

    public function getItems()
    {
        return $this->breadcrumbsManager->getItems();
    }

    public function classes() {
        $classes = [];

        if (!empty($this->property('adv_class'))) {
            $classes[] = $this->property('adv_class');
        }

        if (empty($classes)) {
            return '';
        }

        return ' ' . join(' ', $classes);

    }

    public function onRun()
    {
        $config['paths'] = Config::get('digitfab.core::breadcrumbs.paths');
        $config['params'] = Config::get('digitfab.core::breadcrumbs.params');
        $this->breadcrumbsManager = new \DigitFab\Core\Classes\Breadcrumbs\Breadcrumbs($config, $this->page);
    }

}