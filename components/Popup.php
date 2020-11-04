<?php

namespace DigitFab\Core\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;

class Popup extends ComponentBase
{
    protected $popup;

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);

        $this->popup = \DigitFab\Core\Classes\Popups\Popup::get($this->property('popup'));
    }

    public function componentDetails()
    {
        return [
            'name' => 'digitfab.core::lang.components.popup.name',
            'description' => 'digitfab.core::lang.components.popup.desc',
        ];
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title' => 'digitfab.core::lang.title',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
                'group' => 'digitfab.core::lang.content',
            ],
            'popup' => [
                'title' => 'digitfab.core::lang.popup',
                'description' => '',
                'default' => 'none',
                'type' => 'dropdown',
                'showExternalParam' => false,
                'group' => 'digitfab.core::lang.params',
            ],
            'show_title' => [
                'title' => 'digitfab.core::lang.show_title',
                'description' => '',
                'default' => false,
                'type' => 'checkbox',
                'showExternalParam' => false,
                'group' => 'digitfab.core::lang.params',
            ],
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

    public function checkPopup(): bool
    {
        if (!empty($this->popup)) {
            return true;
        }

        return false;
    }

    public function getPopupOptions(): array
    {
        return \DigitFab\Core\Classes\Popups\Popup::getFormsList();
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