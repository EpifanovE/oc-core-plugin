<?php

namespace DigitFab\Core\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use DigitFab\Core\Models\Address as AddressEntity;
use Lang;

class Address extends ComponentBase
{

    protected $address = null;

    protected $translates = [];

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);

        if ( ! empty($this->property('address')) && $this->property('address') !== 'none') {
            $this->address = AddressEntity::find($this->property('address'));
        }
    }

    public function componentDetails()
    {
        return [
            'name'        => 'digitfab.core::lang.components.address.name',
            'description' => 'digitfab.core::lang.components.address.desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'address'        => [
                'title'             => 'digitfab.core::lang.address',
                'description'       => '',
                'default'           => 'none',
                'type'              => 'dropdown',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'show_title'     => [
                'title'             => 'digitfab.core::lang.show_title',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'title_tag'      => [
                'title'             => 'digitfab.core::lang.title_tag',
                'description'       => '',
                'type'              => 'dropdown',
                'showExternalParam' => false,
                'default'           => 'span',
                'options'           => [
                    'span' => 'span',
                    'div'  => 'div',
                    'h1'   => 'h1',
                    'h2'   => 'h2',
                    'h3'   => 'h3',
                    'h4'   => 'h4',
                    'h5'   => 'h5',
                    'h6'   => 'h6',
                ],
                'group'             => 'digitfab.core::lang.params',
            ],
            'show_labels'    => [
                'title'             => 'digitfab.core::lang.show_labels',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'show_as_list'   => [
                'title'             => 'digitfab.core::lang.show_as_list',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'show_icon'      => [
                'title'             => 'digitfab.core::lang.show_icon',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'microdata'      => [
                'title'             => 'digitfab.core::lang.microdata',
                'description'       => '',
                'default'           => '',
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'adv_class'      => [
                'title'             => 'digitfab.core::lang.adv_class',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'name'           => [
                'title'             => 'digitfab.core::lang.name',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.content',
            ],
            'country'        => [
                'title'             => 'digitfab.core::lang.country',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.content',
            ],
            'region'         => [
                'title'             => 'digitfab.core::lang.region',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.content',
            ],
            'locality'       => [
                'title'             => 'digitfab.core::lang.locality',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.content',
            ],
            'street_address' => [
                'title'             => 'digitfab.core::lang.street_address',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.content',
            ],
            'postal_code'    => [
                'title'             => 'digitfab.core::lang.postal_code',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.content',
            ],
            'latitude'       => [
                'title'             => 'digitfab.core::lang.latitude',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.content',
            ],
            'longitude'      => [
                'title'             => 'digitfab.core::lang.longitude',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.content',
            ],
        ];
    }

    public function getAddressOptions()
    {
        $result = [
            'none' => 'digitfab.core::lang.not_defined'
        ];
        $result = $result + AddressEntity::all()->lists('name', 'id');

        return $result;
    }

    public function getIconClass()
    {
        if ($this->property('icon_class')) {
            return ' ' . $this->property('icon_class');
        }

        return ' fas fa-map-marker-alt';
    }

    public function classes()
    {
        $classes = [
            'IconBox',
        ];

//        if (!$this->property('show_as_list')) {
//            $classes[] = 'address_inline';
//        }

        return join(' ', $classes) . (( ! empty($this->property('adv_class')))
            ? ' ' . $this->property('adv_class')
            : '');
    }

    public function getContent()
    {
        $fields = [
            'postal_code',
            'country',
            'region',
            'locality',
            'street_address',
        ];

        $joinGlue = ($this->property('show_as_list')) ? '' : ', ';

        $content = trim(
            join($joinGlue,
                array_filter(
                    array_map([$this, 'getItem'], $fields),
                    [$this, 'itemsFilter']
                )
            ),
            ', '
        );

        $tag = ($this->property('show_as_list')) ? 'ul' : 'span';
        $content = "<{$tag} class='Address IconBox__Address'>" . $content . "</{$tag}>";

        return $content;
    }

    public function getItem($field)
    {
        return $this->renderPartial('@item.htm', [
            'name' => $field,
            'tag' => ($this->property('show_as_list')) ? 'li' : 'span',
            'show_label' => !!$this->property('show_labels'),
            'content' => $this->getProp($field),
            'schema' => $this->getSchemaItemProp($field),
        ]);
    }

    public function getLabel($name) {
        return Lang::get('digitfab.core::lang.' . $name);
    }

    public function itemsFilter($item)
    {
        return ! empty($item);
    }

    public function getProp($propName)
    {
        if ( ! empty($this->property($propName))) {
            return $this->property($propName);
        }

        if ($this->address && ! empty($this->address->{$propName})) {
            return $this->address->{$propName};
        }

        return '';
    }

    protected function getSchemaItemProp($fieldName)
    {

        if ( ! $this->property('microdata')) {
            return '';
        }

        $map = [
            'country'        => 'addressCountry',
            'region'         => 'addressRegion',
            'locality'       => 'addressLocality',
            'postal_code'    => 'postalCode',
            'street_address' => 'streetAddress',
        ];

        if (isset($map[$fieldName])) {
            return " itemprop='{$map[$fieldName]}'";
        }

        return '';
    }

    public function getSchemaScope()
    {
        if ($this->property('microdata')) {
            return " itemprop='address' itemscope itemtype='http://schema.org/PostalAddress'";
        }

        return '';
    }

    public function getGeo()
    {
        if (
            $this->property('microdata') &&
            ! empty($this->getProp('latitude')) &&
            ! empty($this->getProp('longitude'))
        ) {
            return "<div itemprop='geo' itemscope itemtype='http://schema.org/GeoCoordinates' class='address__geo'>
            <meta itemprop='latitude' content='{$this->getProp('latitude')}' />
            <meta itemprop='longitude' content='{$this->getProp('longitude')}' />
        </div>";
        }

        return '';
    }

    public function getTitleTag()
    {
        if ($this->property('title_tag')) {
            return $this->property('title_tag');
        }

        return 'span';
    }
}
