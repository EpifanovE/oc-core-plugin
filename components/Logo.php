<?php

namespace EEV\Core\Components;

use Cms\Classes\ComponentBase;
use EEV\Core\Models\Settings;

class Logo extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'eev.core::lang.components.logo.name',
            'description' => 'eev.core::lang.components.logo.desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'show_image'      => [
                'title'             => 'eev.core::lang.show_image',
                'description'       => '',
                'default'           => true,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.params',
            ],
            'image_width'     => [
                'title'             => 'eev.core::lang.image_width',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.params',
            ],
            'show_title'      => [
                'title'             => 'eev.core::lang.show_title',
                'description'       => '',
                'default'           => true,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.params',
            ],
            'show_desc'       => [
                'title'             => 'eev.core::lang.show_desc',
                'description'       => '',
                'default'           => true,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.params',
            ],
            'h1_on_home_page' => [
                'title'             => 'eev.core::lang.h1_on_home_page',
                'description'       => '',
                'default'           => true,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.params',
            ],
            'link_to_home_page' => [
                'title'             => 'eev.core::lang.link_to_home_page',
                'description'       => '',
                'default'           => true,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.params',
            ],
            'image_microdata' => [
                'title'             => 'eev.core::lang.image_microdata',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.params',
            ],
            'name_microdata'  => [
                'title'             => 'eev.core::lang.name_microdata',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.params',
            ],
            'adv_class'      => [
                'title'             => 'eev.core::lang.adv_class',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.params',
            ],
            'title'           => [
                'title'             => 'eev.core::lang.title',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.content',
            ],
            'description'     => [
                'title'             => 'eev.core::lang.description',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'eev.core::lang.content',
            ],
        ];
    }

    public function image()
    {
        return Settings::get('logo');
    }

    public function alt()
    {
        return Settings::get('name');
    }

    public function title()
    {
        if ( ! $this->property('show_title')) {
            return '';
        }

        if ($this->property('title')) {
            return $this->property('title');
        }

        return Settings::get('name');
    }

    public function desc()
    {
        if ( ! $this->property('show_desc')) {
            return '';
        }

        if ($this->property('description')) {
            return $this->property('description');
        }

        return Settings::get('short_desc');
    }

    public function classes()
    {
        $classes = [
            'logo',
        ];

        return join(' ', $classes) . (( ! empty($this->property('adv_class')))
                ? ' ' . $this->property('adv_class')
                : '');
    }

    public function imgWrapperStyles()
    {
        $styles = [];

        if ($this->property('image_width')) {
            $styles['max-width'] = $this->property('image_width') . 'px' ?: '200px';
        }

        if ( ! empty($styles)) {
            return $this->style($styles);
        }

        return '';
    }

    public function style(array $styles)
    {
        if ( ! empty($styles)) :
            $result = 'style="';
            $style  = '';
            foreach ($styles as $key => $value) :
                $style .= $key . ':' . $value . ';';
            endforeach;
            $result .= $style;
            $result .= '"';

            return $result;
        endif;

        return '';
    }

    public function getTag() {
        if ($this->property('link_to_home_page') && $this->page->url !== '/') {
            return 'a';
        }
        return 'div';
    }

    public function getAttrs() {
        if ($this->property('link_to_home_page') && $this->page->url !== '/') {
            return ' href="'.url('/').'"';
        }
        return '';
    }

    public function getTextTag()
    {
        if ($this->page->url === '/' && $this->property('h1_on_home_page')) {
            return 'h1';
        }

        return 'div';
    }

    public function imageMicrodata()
    {
        if ($this->property('image_microdata')) {
            return ' itemprop="logo"';
        }

        return '';
    }

    public function nameMicrodata()
    {
        if ($this->property('name_microdata')) {
            return ' itemprop="name"';
        }

        return '';
    }
}
