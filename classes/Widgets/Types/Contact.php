<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use DigitFab\Core\Classes\Company\ContactType;
use DigitFab\Core\Models\Contact as ContactEntity;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;

class Contact extends WidgetType
{
    protected $name = self::CONTACT;

    public function __construct($data, $template)
    {
        parent::__construct($data, $template);

        $this->setData();
    }

    protected function setData() {
        if (!empty($this->data['contact'])) {
            $contact = \DigitFab\Core\Models\Contact::where('id', $this->data['contact'])->first();
            $this->data['contact'] = $contact;
        }

        $this->data['link'] = $this->getLink();
        $this->data['title'] = $this->getTitle();
        $this->data['text'] = $this->getText();
        $this->data['microdata'] = $this->getMicrodata();
        $this->data['icon_class'] = $this->getIconClass();
    }

    protected function getFields()
    {
        return [
            'contact'          => [
                'label'    => Lang::get('digitfab.core::lang.contact'),
                'default'  => '',
                'type'     => 'dropdown',
                'span'     => 'storm',
                'cssClass' => 'col-sm-12',
                'tab'      => Lang::get('digitfab.core::lang.adv_settings'),
                'options'  => $this->getContactsOptions(),
            ],
            'hide_title'       => [
                'label'    => Lang::get('digitfab.core::lang.hide_title'),
                'default'  => false,
                'type'     => 'checkbox',
                'span'     => 'storm',
                'cssClass' => 'col-sm-12',
                'tab'      => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'contact_as_title' => [
                'label'       => Lang::get('digitfab.core::lang.contact_as_title'),
                'description' => '',
                'default'     => false,
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-12',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'title_as_link'    => [
                'label'       => Lang::get('digitfab.core::lang.title_as_link'),
                'description' => '',
                'default'     => false,
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-12',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'text_as_link'     => [
                'label'       => Lang::get('digitfab.core::lang.text_as_link'),
                'description' => '',
                'default'     => false,
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-12',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'icon_class'       => [
                'label'             => Lang::get('digitfab.core::lang.icon_css_class'),
                'span'     => 'storm',
                'cssClass' => 'col-sm-12',
                'type'     => 'text',
                'tab'      => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'microdata' => [
                'label' => Lang::get('digitfab.core::lang.microdata'),
                'description' => '',
                'default'     => false,
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-12',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'title'            => [
                'label'    => Lang::get('digitfab.core::lang.title'),
                'span'     => 'storm',
                'cssClass' => 'col-sm-6',
                'type'     => 'text',
                'tab'      => Lang::get('digitfab.core::lang.content'),
            ],
            'type'             => [
                'label'    => Lang::get('digitfab.core::lang.type'),
                'default'  => '',
                'type'     => 'dropdown',
                'span'     => 'storm',
                'cssClass' => 'col-sm-6',
                'tab'      => Lang::get('digitfab.core::lang.content'),
                'options'  => $this->getTypesOptions(),
            ],
            'text'             => [
                'label'    => Lang::get('digitfab.core::lang.text'),
                'span'     => 'storm',
                'cssClass' => 'col-sm-6',
                'type'     => 'text',
                'tab'      => Lang::get('digitfab.core::lang.content'),
            ],
            'link'             => [
                'label'    => Lang::get('digitfab.core::lang.link'),
                'span'     => 'storm',
                'cssClass' => 'col-sm-6',
                'type'     => 'text',
                'tab'      => Lang::get('digitfab.core::lang.content'),
            ],
        ];
    }

    protected function getContactsOptions()
    {
        $result = [
            'none' => 'digitfab.core::lang.not_defined'
        ];
        $result = $result + ContactEntity::all()->lists('title', 'id');

        return $result;
    }

    protected function getTypesOptions()
    {
        return ContactType::get();
    }

    public function getTitle()
    {
        if (!empty($this->data['title'])) {
            return $this->data['title'];
        }

        if (!empty($this->data['contact_as_title'])
            && $this->isCorrectContact()
            && !empty($this->data['contact']->text)
        ) {
            return $this->data['contact']->text;
        }

        if ($this->isCorrectContact() && !empty($this->data['contact']->title)) {
            return $this->data['contact']->title;
        }

        return '';
    }

    public function getText()
    {
        if (!empty(!empty($this->data['text']))) {
            return $this->data['text'];
        }

        if (!empty($this->data['contact_as_title'])
            && $this->isCorrectContact()
            && !empty($this->data['contact']->title)
        ) {
            return $this->data['contact']->title;
        }

        if ($this->isCorrectContact() && !empty($this->data['contact']->text)) {
            return $this->data['contact']->text;
        }

        return '';
    }

    protected function getLink()
    {
        if (!empty($this->data['link'])) {
            return $this->data['link'];
        }

        if (
            $this->isCorrectContact()
            && !empty($this->data['contact']->link)
        ) {
            return $this->data['contact']->link;
        }

        return '';
    }

    public function getMicrodata()
    {

        if (!$this->getType()) {
            return '';
        }

        if (empty($this->data['microdata'])) {
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

    public function getIconClass()
    {

        if (!empty($this->data['icon_class'])) {
            return ' ' . $this->data['icon_class'];
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
        if (!empty($this->data['type']) && $this->data['type'] !== 'none') {
            return $this->data['type'];
        }

        if (!empty($this->data['contact']) && !empty($this->data['contact']->type)) {
            return $this->data['contact']->type;
        }

        return '';
    }

    protected function isCorrectContact() {
        return isset($this->data['contact']) && is_a($this->data['contact'], \DigitFab\Core\Models\Contact::class);
    }
}