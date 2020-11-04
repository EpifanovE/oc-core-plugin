<?php

namespace DigitFab\Core\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use DigitFab\Core\Classes\Company\ContactType;
use DigitFab\Core\Models\Contact as ContactEntity;

class Contact extends ComponentBase
{
    protected $contact = null;

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);

        if (!empty($this->property('contact')) && $this->property('contact') !== 'none') {
            $this->contact = ContactEntity::find($this->property('contact'));
        }
    }

    public function componentDetails()
    {
        return [
            'name'        => 'digitfab.core::lang.components.contact.name',
            'description' => 'digitfab.core::lang.components.contact.desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'contact' => [
                'title' => 'digitfab.core::lang.contact',
                'description' => '',
                'default' => 'none',
                'type' => 'dropdown',
                'showExternalParam' => false,
            ],
            'title' => [
                'title' => 'digitfab.core::lang.title',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
            ],
            'hide_title' => [
                'title' => 'digitfab.core::lang.hide_title',
                'description' => '',
                'default' => false,
                'type' => 'checkbox',
                'showExternalParam' => false,
            ],
            'text' => [
                'title' => 'digitfab.core::lang.text',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
            ],
            'contact_as_title' => [
                'title' => 'digitfab.core::lang.contact_as_title',
                'description' => '',
                'default' => '',
                'type' => 'checkbox',
                'showExternalParam' => false,
            ],
            'link' => [
                'title' => 'digitfab.core::lang.link',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
            ],
            'title_as_link' => [
                'title' => 'digitfab.core::lang.title_as_link',
                'description' => '',
                'default' => '',
                'type' => 'checkbox',
                'showExternalParam' => false,
            ],
            'text_as_link' => [
                'title' => 'digitfab.core::lang.text_as_link',
                'description' => '',
                'default' => '',
                'type' => 'checkbox',
                'showExternalParam' => false,
            ],
            'type' => [
                'title' => 'digitfab.core::lang.type',
                'description' => '',
                'default' => 'none',
                'type' => 'dropdown',
                'showExternalParam' => false,
            ],
            'icon_class' => [
                'title' => 'digitfab.core::lang.icon_css_class',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
            ],
            'microdata' => [
                'title' => 'digitfab.core::lang.microdata',
                'description' => '',
                'default' => '',
                'type' => 'checkbox',
                'showExternalParam' => false,
            ],
            'adv_class'      => [
                'title'             => 'digitfab.core::lang.adv_class',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
            ],
        ];
    }

    public function getTypeOptions()
    {
        return ContactType::get();
    }

    public function getContactOptions()
    {
        $result = [
            'none' => 'digitfab.core::lang.not_defined'
        ];
        $result = $result + ContactEntity::all()->lists('title', 'id');
        return $result;
    }

    public function getMicrodata()
    {

        if (!$this->getType()) {
            return '';
        }

        $map = [
            'phone' => 'telephone',
            'email' => 'email',
        ];

        if (!isset($map[$this->getType()])) {
            return '';
        }

        return $map[$this->getType()];
    }

    public function classes()
    {
        $classes = [
            'contact',
        ];

        if ($this->getType()) {
            $classes[] = 'contact_' . $this->getType();
        }

        if (empty($this->property('text'))) {
            $classes[] = 'contact_no-text';
        }

        if (empty($this->getType()) && empty($this->property('icon_class'))) {
            $classes[] = 'contact_no-icon';
        }

        return join(' ', $classes) . (( ! empty($this->property('adv_class')))
                ? ' ' . $this->property('adv_class')
                : '');
    }

    public function getIconClass()
    {

        if ($this->property('icon_class')) {
            return ' ' . $this->property('icon_class');
        }

        if (empty($this->getType())) {
            return '';
        }

        $map = [
            'phone' => 'fas fa-phone',
            'email' => 'fas fa-envelope',
            'fax' => 'fas fa-fax',
            'skype' => 'fab fa-skype',
            'viber' => 'fab fa-viber',
            'telegram' => 'fab fa-telegram',
            'WhatsApp' => 'fab fa-whatsapp',
        ];

        if (!isset($map[$this->getType()])) {
            return '';
        }

        return ' ' . $map[$this->getType()];
    }

    public function getType() {
        if (!empty($this->property('type')) && $this->property('type') !== 'none') {
            return $this->property('type');
        }

        if ($this->contact && !empty($this->contact->type)) {
            return $this->contact->type;
        }

        return '';
    }

    public function getTitle()
    {
        if (!empty($this->property('title'))) {
            return $this->property('title');
        }

        if ($this->property('contact_as_title')
            && $this->contact
            && !empty($this->contact->text)
        ) {
            return $this->contact->text;
        }

        if ($this->contact && !empty($this->contact->title)) {
            return $this->contact->title;
        }

        return '';
    }

    public function getText()
    {
        if (!empty($this->property('text'))) {
            return $this->property('text');
        }

        if ($this->property('contact_as_title')
            && $this->contact
            && !empty($this->contact->title)
        ) {
            return $this->contact->title;
        }

        if ($this->contact && !empty($this->contact->text)) {
            return $this->contact->text;
        }

        return '';
    }

    public function getLink()
    {
        if (!empty($this->property('link'))) {
            return $this->property('link');
        }

        if ($this->contact && !empty($this->contact->link)) {
            return $this->contact->link;
        }

        return '';
    }

}