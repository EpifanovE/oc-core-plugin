<?php

namespace EEV\Core\Classes\Widgets\Types;

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
    const CTA = 'cta';
    const GALLERY = 'gallery';

    public function __construct($data, $template)
    {
        $this->data = $data;
        $this->template = $template;
        $this->generatedId = $this->generateId();
    }

    public static function getTypes()
    {
        $types = [
            self::HERO => [
                'name' => Lang::get('eev.core::lang.widgets_types.hero.name'),
                'class' => Hero::class,
            ],
            self::ABOUT => [
                'name' => Lang::get('eev.core::lang.widgets_types.about.name'),
                'class' => About::class,
            ],
            self::ICONCARD => [
                'name' => Lang::get('eev.core::lang.widgets_types.iconscard.name'),
                'class' => IconCard::class,
            ],
            self::EDITOR => [
                'name' => Lang::get('eev.core::lang.widgets_types.editor.name'),
                'class' => Editor::class,
            ],
            self::CTA => [
                'name' => Lang::get('eev.core::lang.widgets_types.cta.name'),
                'class' => CallToAction::class,
            ],
            self::GALLERY => [
                'name' => Lang::get('eev.core::lang.widgets_types.gallery.name'),
                'class' => Gallery::class,
            ],
        ];

        $newTypes = [];

        $newTypes = Event::fire('eev.core.widgets', [$newTypes]);

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
        if (!empty(self::getTypes()[$type])) {
            return self::getTypes()[$type]['name'];
        }
    }

    public function getHtml($componentProperties)
    {
        if ($themeTpl = $this->getThemeHtml($componentProperties)) {
            return $themeTpl;
        }

        if ($pluginTpl = $this->getPluginHtml($componentProperties)) {
            return $pluginTpl;
        }

        return '';
    }

    protected function getThemeHtml($componentProperties)
    {
        $themeName = Config::get('cms.activeTheme');

        $themeViewFile = themes_path() . '/' . $themeName . '/widgets/' . $this->name . '.htm';

        if (file_exists($themeViewFile)) {
            return Twig::parse(file_get_contents($themeViewFile), [
                'data' => $this->getTemplateData($componentProperties),
                'classes' => $this->classes($componentProperties['adv_class']),
                'componentProperties' => $componentProperties,
            ]);
        }

        return '';
    }

    protected function getPluginHtml($componentProperties)
    {
        $template = $this->getPluginViewsNamespace() . '::widgets.' . $this->name;

        if (View::exists($template)) {
            return View::make($template, [
                'data' => $this->getTemplateData($componentProperties),
                'classes' => $this->classes($componentProperties['adv_class']),
                'componentProperties' => $componentProperties,
            ]);
        }

        return '';
    }

    protected function getTemplateData($componentProperties)
    {
        $data = $this->data;

        $data['widget'] = [
            'id' => $this->getId($componentProperties),
            'overlay' => ! empty($this->data['background_image']),
        ];

        if (method_exists($this, 'doTemplateData')) {
            return array_merge($data, $this->doTemplateData($componentProperties));
        }

        return $data;
    }

    protected function getPluginViewsNamespace()
    {
        return 'eev.core';
    }

    public function getDataFields()
    {
        if (!method_exists($this, 'getFields')) {
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

    public function classes($componentClass = null)
    {
        $classes = !empty($componentClass) ? [$componentClass] : [];

        if (method_exists($this, 'getClasses') && is_array($this->getClasses())) {
            $classes = array_merge($classes, $this->getClasses());
        }

        return ' ' . join(' ', $classes);
    }

    protected static function getTypesArray($array)
    {
        if (empty($array)) {
            return [];
        }

        $result = [];

        foreach ($array as $item) {

            if (!is_array($item)) {
                continue;
            }

            $result = array_merge($result, $item);
        }

        return $result;
    }

    protected function getId($componentProperties) {
        return $componentProperties['id'] ? $componentProperties['id'] : $this->generatedId;
    }

    protected function generateId() {
        return $this->name . '-' . uniqid();
    }

}