<?php

namespace DigitFab\Core;

use Backend\Widgets\Form;
use DigitFab\Core\Classes\Forms\Rules\ReCaptcha;
use DigitFab\Core\Classes\Widgets\AreasManager;
use DigitFab\Core\Components\InlineScripts;
use DigitFab\Core\Rules\AreaValidationRule;
use DigitFab\Core\Components\Breadcrumbs;
use DigitFab\Core\Components\InlineStyles;
use DigitFab\Core\Components\Logo;
use DigitFab\Core\Components\Popup;
use DigitFab\Core\Components\Form as FormComponent;
use DigitFab\Core\Controllers\WidgetController;
use DigitFab\Core\Models\Settings;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use System\Classes\PluginBase;

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
                    'about-carousel'        => [
                        'dots' => false,
                    ],
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
        Validator::extend('recaptcha', ReCaptcha::class);
        Validator::extend('area', AreaValidationRule::class);

        parent::boot();
    }

    public function registerComponents()
    {
        return [
            InlineStyles::class  => 'inlineStyles',
            InlineScripts::class  => 'inlineScripts',
            Breadcrumbs::class   => 'breadcrumbs',
            Logo::class          => 'logo',
            FormComponent::class => 'form',
            Popup::class         => 'popup',
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