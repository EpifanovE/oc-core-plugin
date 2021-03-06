<?php

namespace DigitFab\Core;

use Backend\Widgets\Form;
use DigitFab\Core\Classes\Forms\Rules\ReCaptcha;
use DigitFab\Core\Classes\TagProcessor;
use DigitFab\Core\Classes\Widgets\AreasManager;
use DigitFab\Core\Components\Core;
use DigitFab\Core\Components\InlineScripts;
use DigitFab\Core\Rules\AreaValidationRule;
use DigitFab\Core\Components\InlineStyles;
use DigitFab\Core\Components\Logo;
use DigitFab\Core\Components\Popup;
use DigitFab\Core\Components\Form as FormComponent;
use DigitFab\Core\Controllers\WidgetController;
use DigitFab\Core\Models\Settings;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use System\Classes\PluginBase;
use Backend\Models\User as Admin;

class Plugin extends PluginBase
{

    public function __construct($app)
    {
        parent::__construct($app);

        WidgetController::extendFormFields(function (Form $form, $model, $context) {
            /**
             * @var Models\Widget $model
             */
            if ( ! empty($model->type)) {
                $form->removeField('type');
            } else {
                $form->removeField('template');

                return;
            }

            if ( ! empty($fields = $model->getTypeObject()->getDataFields())) {
                if ( ! $form->isNested) {
                    $form->addTabFields($fields);
                }
            }
        });

        // TODO: Move to components and widgets
        Event::listen('digitfab.core.inlineScripts', function ($app) {
            return array_merge($app, [
                'CookiesConfirmation' => false,
                'Owl'                 => [
                    'testimonials-carousel' => [
                        'responsive' => [
                            "0"    => ["items" => 1, "margin" => 0],
                            "1024" => ["items" => 2, "margin" => 30],
                        ],
                    ],
                ],
            ]);
        });
    }

    public function boot()
    {
        Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addCss('/plugins/digitfab/core/assets/css/style.min.css');
        });

        Admin::extend(function ($model) {
            $model->addDynamicMethod('getDisplayNameAttribute', function () use ($model) {
                return $model->first_name . ' - ' . $model->last_name;
            });
        });

        Admin::extend(function ($model) {
            $model->addDynamicMethod('getAdminNameEmailAttribute', function () use ($model) {
                return $model->getFullNameAttribute() . ' - ' . $model->email;;
            });
        });

        Validator::extend('recaptcha', ReCaptcha::class);
        Validator::extend('area', AreaValidationRule::class);

        App::singleton(TagProcessor::class, function ($app) {
            return new TagProcessor(Config::get('digitfab.core::tags'));
        });

        parent::boot();
    }

    public function registerComponents()
    {
        return [
            InlineStyles::class  => 'inlineStyles',
            InlineScripts::class => 'inlineScripts',
            Logo::class          => 'logo',
            FormComponent::class => 'form',
            Popup::class         => 'popup',
            Core::class => 'core',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'digitfab.core::lang.company_settings',
                'description' => '',
                'category'    => 'digitfab.core::lang.company',
                'class'       => Settings::class,
                'icon'        => 'icon-globe',
                'order'       => 500,
                'keywords'    => ''
            ],
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters'   => [
                'trans' => [$this, 'getTranslate'],
            ],
            'functions' => [
                'df_area' => [$this, 'getArea'],
            ]
        ];
    }

    public function getTranslate($message, $variables = [])
    {
        return Lang::get($message, $variables);
    }

    public function getArea($name)
    {
        $areasManager = new AreasManager();
        $area         = $areasManager->getArea($name);

        return $area->getWidgets();
    }
}
