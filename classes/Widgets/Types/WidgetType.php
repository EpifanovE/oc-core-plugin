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

    protected $id;

    protected $classes;

    protected $template;

    protected $type;

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

    public function __construct($type, $data, $id, $classes, $template)
    {
        $this->type = $type;
        $this->data        = $data;
        $this->template    = $template;
        $this->classes = $classes;
        $this->id = $this->getId($id, $type);

        if (method_exists($this, 'setData')) {
            $this->setData();
        }
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

    public static function getTypeObject($type, $data, $id, $classes, $template)
    {
        $map = array_map(function ($item) {
            return $item['class'];
        }, self::getTypes());

        if (isset($map[$type])) {
            $class = $map[$type];

            return new $class($type, $data, $id, $classes, $template);
        }
    }

    public static function getTypeLabel($type)
    {
        if ( ! empty(self::getTypes()[$type])) {
            return self::getTypes()[$type]['name'];
        }
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

    public function getHtml()
    {
        $tplData = [
            'data'                => $this->getTemplateData($this->data),
            'widget' => [
                'id'      => $this->id,
                'classes' => $this->classes(),
                'attrs' => $this->getAttrs(),
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

    protected function getAttrs() {
        $attrs = [];

        if (!empty($this->getStyles())) {
            $attrs['style'] = $this->getStyles();
        }

        if (method_exists($this, 'doAttrs')) {
            $attrs = array_merge($attrs, $this->doAttrs());
        }

        if (empty($attrs)) {
            return '';
        }

        $result = '';

        foreach ($attrs as $key => $value) {
            $result .= " {$key}={$value}";
        }

        return $result;
    }

    protected function getStyles()
    {
        if (!method_exists($this, 'doStyles')) {
            return '';
        }

        $stylesArray = $this->doStyles();

        if (empty($stylesArray)) {
            return '';
        }

        $stylesString = "";

        foreach ($stylesArray as $key => $value) {
            $stylesString .= "{$key}:{$value};";
        }

        return $stylesString;
    }

    protected function classes()
    {
        $classes = ! empty($this->classes) ? [trim($this->classes)] : [];

        if (method_exists($this, 'doClasses') && !empty($this->doClasses())) {
            $advClasses = is_array($this->doClasses()) ? $this->doClasses() : [$this->doClasses()];
            $classes = array_merge($classes, $advClasses);
        }

        return empty($classes) ? '' : ' ' . join(' ', $classes);
    }

    protected function getId($id, $type)
    {
        return "widget-{$type}-{$id}";
    }
}
