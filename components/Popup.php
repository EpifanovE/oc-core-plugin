<?php

namespace EEV\Core\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;

class Popup extends ComponentBase
{
    protected $popup;

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);

        $this->popup = \EEV\Core\Classes\Popups\Popup::get($this->property('popup'));
    }

    public function componentDetails()
    {
        return [
            'name' => 'eev.core::lang.components.popup.name',
            'description' => 'eev.core::lang.components.popup.desc',
        ];
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title' => 'eev.core::lang.title',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
                'group' => 'eev.core::lang.content',
            ],
            'popup' => [
                'title' => 'eev.core::lang.popup',
                'description' => '',
                'default' => 'none',
                'type' => 'dropdown',
                'showExternalParam' => false,
                'group' => 'eev.core::lang.params',
            ],
            'show_title' => [
                'title' => 'eev.core::lang.show_title',
                'description' => '',
                'default' => false,
                'type' => 'checkbox',
                'showExternalParam' => false,
                'group' => 'eev.core::lang.params',
            ],
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

    public function checkPopup(): bool
    {
        if (!empty($this->popup)) {
            return true;
        }

        return false;
    }

    public function getPopupOptions(): array
    {
        return \EEV\Core\Classes\Popups\Popup::getFormsList();
    }

    public function getPartial(): string
    {
        return $this->popup->getPartial();
    }

    public function getId()
    {
        return $this->popup->getName();
    }

    public function getClasses(): string
    {
        $classes = [
            'popup',
            'popup_' . $this->popup->getName(),
            'mfp-hide',
        ];

        if (!empty($this->property('adv_class'))) {
            $classes[] = $this->property('adv_class');
        }

        return join(' ', $classes);
    }

    public function getData(): array
    {
        $data = [];

        $data['type'] = $this->popup->getType();

        return $data;
    }

    public function getTitle(): string
    {
        if (!$this->property('show_title')) {
            return '';
        }

        if (!empty($this->property('title'))) {
            return $this->property('title');
        }

        if (!$this->popup->getTitle()) {
            return '';
        }

        return $this->popup->getTitle();
    }
}