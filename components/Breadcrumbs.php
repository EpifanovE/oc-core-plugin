<?php

namespace EEV\Core\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Config;

class Breadcrumbs extends ComponentBase
{
    /**
     * @var \EEV\Core\Classes\Breadcrumbs\Breadcrumbs
     */
    protected $breadcrumbsManager;

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);
    }

    public function componentDetails()
    {
        return [
            'name' => 'eev.core::lang.components.breadcrumbs.name',
            'description' => 'eev.core::lang.components.breadcrumbs.desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'adv_class' => [
                'title' => 'eev.core::lang.adv_class',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
                'group' => 'eev.core::lang.params',
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
        $config['paths'] = Config::get('eev.core::breadcrumbs.paths');
        $config['params'] = Config::get('eev.core::breadcrumbs.params');
        $this->breadcrumbsManager = new \EEV\Core\Classes\Breadcrumbs\Breadcrumbs($config, $this->page);
    }

}