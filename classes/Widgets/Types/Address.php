<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use DigitFab\Core\Models\Address as AddressEntity;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;

class Address extends WidgetType
{
    protected $name = self::ADDRESS;

    public function __construct($data, $template)
    {
        parent::__construct($data, $template);

        $this->setData();
    }

    protected function setData() {
        if ( ! empty($this->data['address'])) {
            $contact                     = \DigitFab\Core\Models\Address::where('id',
                $this->data['address'])->first();
            $this->data['address'] = $contact;
        }

        $this->data['classes'] = 'IconBox';
        $this->data['icon_class'] = $this->getIconClass();
        $this->data['show_icon'] = $this->isIconShow();
        $this->data['title']      = $this->getTitle();
        $this->data['content']       = $this->getContent();
        $this->data['geo']  = $this->getGeo();
        $this->data['schema_scope'] = $this->getSchemaScope();
    }

    protected function getFields()
    {
        return [
            'address'        => [
                'label'       => 'digitfab.core::lang.address',
                'description' => '',
                'default'     => 'none',
                'type'        => 'dropdown',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-12',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
                'options'     => $this->getAddressOptions(),
            ],
            'show_title'     => [
                'label'       => 'digitfab.core::lang.show_title',
                'description' => '',
                'default'     => false,
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'show_labels'    => [
                'label'       => 'digitfab.core::lang.show_labels',
                'description' => '',
                'default'     => false,
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'show_as_list'   => [
                'label'       => 'digitfab.core::lang.show_as_list',
                'description' => '',
                'default'     => false,
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'show_icon'      => [
                'label'       => 'digitfab.core::lang.show_icon',
                'description' => '',
                'default'     => false,
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'microdata'      => [
                'label'       => 'digitfab.core::lang.microdata',
                'description' => '',
                'default'     => '',
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'name'           => [
                'label'       => 'digitfab.core::lang.name',
                'description' => '',
                'default'     => '',
                'type'        => 'text',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.content'),
            ],
            'country'        => [
                'label'       => 'digitfab.core::lang.country',
                'description' => '',
                'default'     => '',
                'type'        => 'text',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.content'),
            ],
            'region'         => [
                'label'       => 'digitfab.core::lang.region',
                'description' => '',
                'default'     => '',
                'type'        => 'text',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.content'),
            ],
            'locality'       => [
                'label'       => 'digitfab.core::lang.locality',
                'description' => '',
                'default'     => '',
                'type'        => 'text',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.content'),
            ],
            'street_address' => [
                'label'       => 'digitfab.core::lang.street_address',
                'description' => '',
                'default'     => '',
                'type'        => 'text',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.content'),
            ],
            'postal_code'    => [
                'label'       => 'digitfab.core::lang.postal_code',
                'description' => '',
                'default'     => '',
                'type'        => 'text',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.content'),
            ],
            'latitude'       => [
                'label'       => 'digitfab.core::lang.latitude',
                'description' => '',
                'default'     => '',
                'type'        => 'text',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.content'),
            ],
            'longitude'      => [
                'label'       => 'digitfab.core::lang.longitude',
                'description' => '',
                'default'     => '',
                'type'        => 'text',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-6',
                'tab'         => Lang::get('digitfab.core::lang.content'),
            ],
        ];
    }

    protected function getAddressOptions()
    {
        $result = [
            'none' => 'digitfab.core::lang.not_defined'
        ];
        $result = $result + AddressEntity::all()->lists('name', 'id');

        return $result;
    }

    protected function getIconClass()
    {
        if (!empty($this->data['icon_class'])) {
            return ' ' . $this->data['icon_class'];
        }

        return ' fas fa-map-marker-alt';
    }

    protected function isIconShow() {
        return !empty($this->data['show_icon']);
    }

    protected function getContent()
    {
        $fields = [
            'postal_code',
            'country',
            'region',
            'locality',
            'street_address',
        ];

        $joinGlue = (!empty($this->data['show_as_list'])) ? '' : ', ';

        $content = trim(
            join($joinGlue,
                array_filter(
                    array_map([$this, 'getItem'], $fields),
                    [$this, 'itemsFilter']
                )
            ),
            ', '
        );

        $tag     = (!empty($this->data['show_as_list'])) ? 'ul' : 'span';
        $content = "<{$tag} class='Address IconBox__Address'>" . $content . "</{$tag}>";

        return $content;
    }

    protected function getItem($field)
    {
        return View::make($this->getPluginViewsNamespace() . '::widgets.address.item', [
            'name'       => $field,
            'tag'        => (!empty($this->data['show_as_list'])) ? 'li' : 'span',
            'show_label' => $this->data['show_labels'] ?? false,
            'label' => $this->getLabel($field),
            'content'    => $this->getProp($field),
            'schema'     => $this->getSchemaItemProp($field),
        ]);
    }

    protected function getLabel($name)
    {
        return Lang::get('digitfab.core::lang.' . $name) . ':';
    }

    protected function itemsFilter($item)
    {
        return ! empty($item);
    }

    protected function getProp($propName)
    {
        if ( ! empty($this->data[$propName])) {
            return $this->data[$propName];
        }

        if ($this->isCorrectAddress() && ! empty($this->data['address']->{$propName})) {
            return $this->data['address']->{$propName};
        }

        return '';
    }

    protected function getSchemaItemProp($fieldName)
    {

        if (empty($this->data['microdata'])) {
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

    protected function getSchemaScope()
    {
        if ( ! empty($this->data['microdata'])) {
            return " itemprop='address' itemscope itemtype='http://schema.org/PostalAddress'";
        }

        return '';
    }

    protected function getGeo()
    {
        $latitude = $this->getProp('latitude');
        $longitude = $this->getProp('longitude');

        if (
            ! empty($this->data['microdata']) &&
            ! empty($latitude) &&
            ! empty($longitude)
        ) {
            return "<div itemprop='geo' itemscope itemtype='http://schema.org/GeoCoordinates' class='address__geo'>
                <meta itemprop='latitude' content='{$latitude}' />
                <meta itemprop='longitude' content='{$longitude}' />
            </div>";
        }

        return '';
    }

    protected function isCorrectAddress()
    {
        return isset($this->data['address']) && is_a($this->data['address'],
                \DigitFab\Core\Models\Address::class);
    }

    protected function getTitle()
    {
        if (!empty($this->data['name'])) {
            return $this->data['name'];
        }

        if (!empty($this->data['address']->name)) {
            return $this->data['address']->name;
        }

        return '';
    }
}