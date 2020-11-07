<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use October\Rain\Support\Facades\Twig;

abstract class WidgetType
{
    protected $name;

    protected $data;

    protected $template;

    protected $generatedId;

    const HERO = 'hero';
    const ABOUT = 'about';
    const ICONCARD = 'iconcard';
    const EDITOR = 'editor';
    const CODE = 'code';
    const CTA = 'cta';
    const GALLERY = 'gallery';
    const CONTACT = 'contact';
    const ADDRESS = 'address';
    const OPENING_HOURS = 'opening_hours';
    const SOCIALS = 'socials';

    public function __construct($data, $template)
    {
        $this->data        = $data;
        $this->template    = $template;
        $this->generatedId = $this->generateId();
    }

    public static function getTypes()
    {
        $types = [
            self::HERO     => [
                'name'  => Lang::get('digitfab.core::lang.widgets_types.hero.name'),
                'class' => Hero::class,
            ],
            self::ABOUT    => [
                'name'  => Lang::get('digitfab.core::lang.widgets_types.about.name'),
                'class' => About::class,
            ],
            self::ICONCARD => [
                'name'  => Lang::get('digitfab.core::lang.widgets_types.iconscard.name'),
                'class' => IconCard::class,
            ],
            self::EDITOR   => [
                'name'  => Lang::get('digitfab.core::lang.widgets_types.editor.name'),
                'class' => Editor::class,
            ],
            self::CTA      => [
                'name'  => Lang::get('digitfab.core::lang.widgets_types.cta.name'),
                'class' => CallToAction::class,
            ],
            self::GALLERY  => [
                'name'  => Lang::get('digitfab.core::lang.widgets_types.gallery.name'),
                'class' => Gallery::class,
            ],
            self::CONTACT  => [
                'name'  => Lang::get('digitfab.core::lang.widgets_types.contact.name'),
                'class' => Contact::class,
            ],
            self::ADDRESS  => [
                'name'  => Lang::get('digitfab.core::lang.widgets_types.address.name'),
                'class' => Address::class,
            ],
            self::OPENING_HOURS  => [
                'name'  => Lang::get('digitfab.core::lang.widgets_types.opening_hours.name'),
                'class' => OpeningHours::class,
            ],
            self::SOCIALS  => [
                'name'  => Lang::get('digitfab.core::lang.widgets_types.socials.name'),
                'class' => Socials::class,
            ],
            self::CODE  => [
                'name'  => Lang::get('digitfab.core::lang.widgets_types.code.name'),
                'class' => Code::class,
            ],
        ];

        $newTypes = [];

        $newTypes = Event::fire('digitfab.core.widgets', [$newTypes]);

        return array_merge($types, self::getTypesArray($newTypes));
    }

    public static function getOptions()
    {
        return array_map(function ($item) {
            return $item['name'];
        }, self::getTypes());
    }

    public static function getTypeObject($type, $data, $template)
    {
        $map = array_map(function ($item) {
            return $item['class'];
        }, self::getTypes());

        if (isset($map[$type])) {
            $class = $map[$type];

            return new $class($data, $template);
        }
    }

    public static function getTypeLabel($type)
    {
        if ( ! empty(self::getTypes()[$type])) {
            return self::getTypes()[$type]['name'];
        }
    }

    public function getHtml($params)
    {
        $tplData = [
            'data'                => $this->getTemplateData($params['data']),
            'widget' => [
                'id'      => $this->getId($params),
                'classes' => $this->classes($params['classes']),
            ],
        ];

        if ($themeTpl = $this->getThemeHtml($tplData)) {
            return $themeTpl;
        }

        if ($pluginTpl = $this->getPluginHtml($tplData)) {
            return $pluginTpl;
        }

        return '';
    }

    protected function getThemeHtml($params)
    {
        $themeName = Config::get('cms.activeTheme');

        $themeViewFile = themes_path() . '/' . $themeName . '/widgets/' . $this->name . '.htm';

        if (file_exists($themeViewFile)) {
            return Twig::parse(file_get_contents($themeViewFile), $params);
        }

        return '';
    }

    protected function getPluginHtml($params)
    {
        $template = $this->getPluginViewsNamespace() . '::widgets.' . $this->name;

        if (View::exists($template)) {
            return View::make($template, $params);
        }

        return '';
    }

    protected function getTemplateData($componentProperties)
    {
        $data = $this->data;

        if (method_exists($this, 'doTemplateData')) {
            return array_merge($data, $this->doTemplateData($componentProperties));
        }

        return $data;
    }

    protected function getPluginViewsNamespace()
    {
        return 'digitfab.core';
    }

    public function getDataFields()
    {
        if ( ! method_exists($this, 'getFields')) {
            return [];
        }

        $fields = $this->getFields();


        foreach ($fields as $key => $field) {
            $fields['data[' . $key . ']'] = $field;
            unset($fields[$key]);
        }

        return $fields;
    }

    public function getStyles($componentProperties)
    {
        $styles       = [];
        $baseMediaUrl = url(Config::get('cms.storage.media.path'));

        if ( ! empty($this->data['background_image'])) {
            $styles['#' . $this->getId($componentProperties)] = [
                'background-image' => 'url("' . $baseMediaUrl . $this->data['background_image'] . '")',
            ];
        }

        if (method_exists($this, 'doStyles')) {
            $styles = array_merge($styles, $this->doStyles());
        }

        return $styles;
    }

    protected function classes($advClasses = null)
    {
        $classes = ! empty($advClasses) ? [trim($advClasses)] : [];

        if (method_exists($this, 'getClasses') && is_array($this->getClasses())) {
            $classes = array_merge($classes, $this->getClasses());
        }

        return empty($classes) ? '' : ' ' . join(' ', $classes);
    }

    protected static function getTypesArray($array)
    {
        if (empty($array)) {
            return [];
        }

        $result = [];

        foreach ($array as $item) {

            if ( ! is_array($item)) {
                continue;
            }

            $result = array_merge($result, $item);
        }

        return $result;
    }

    protected function getId($params)
    {
        return isset($params['id']) ? "widget-{$params['type']}-{$params['id']}" : $this->generatedId;
    }

    protected function generateId()
    {
        return $this->name . '-' . uniqid();
    }

}