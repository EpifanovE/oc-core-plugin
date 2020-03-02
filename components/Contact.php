<?php

namespace EEV\Core\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use EEV\Core\Classes\Company\ContactType;
use EEV\Core\Models\Contact as ContactEntity;

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
            'name'        => 'eev.core::lang.components.contact.name',
            'description' => 'eev.core::lang.components.contact.desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'contact' => [
                'title' => 'eev.core::lang.contact',
                'description' => '',
                'default' => 'none',
                'type' => 'dropdown',
                'showExternalParam' => false,
            ],
            'title' => [
                'title' => 'eev.core::lang.title',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
            ],
            'show_title' => [
                'title' => 'eev.core::lang.show_title',
                'description' => '',
                'default' => false,
                'type' => 'checkbox',
                'showExternalParam' => false,
            ],
            'text' => [
                'title' => 'eev.core::lang.text',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
            ],
            'link' => [
                'title' => 'eev.core::lang.link',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
            ],
            'type' => [
                'title' => 'eev.core::lang.type',
                'description' => '',
                'default' => 'none',
                'type' => 'dropdown',
                'showExternalParam' => false,
            ],
            'icon_class' => [
                'title' => 'eev.core::lang.icon_css_class',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
            ],
            'microdata' => [
                'title' => 'eev.core::lang.microdata',
                'description' => '',
                'default' => '',
                'type' => 'checkbox',
                'showExternalParam' => false,
            ],
            'adv_class'      => [
                'title'             => 'eev.core::lang.adv_class',
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
            'none' => 'eev.core::lang.not_defined'
        ];
        $result = $result + ContactEntity::all()->lists('text', 'id');
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