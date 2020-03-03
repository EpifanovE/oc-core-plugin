<?php

namespace EEV\Core;

use EEV\Core\Classes\Forms\Rules\ReCaptcha;
use EEV\Core\Classes\ThemeStyles;
use EEV\Core\Components\Address;
use EEV\Core\Components\Breadcrumbs;
use EEV\Core\Components\Contact;
use EEV\Core\Components\Form;
use EEV\Core\Components\InlineStyles;
use EEV\Core\Components\Logo;
use EEV\Core\Components\OpeningHours;
use EEV\Core\Components\Popup;
use EEV\Core\Components\Socials;
use EEV\Core\Components\Widget;
use EEV\Core\Controllers\WidgetController;
use EEV\Core\Models\Settings;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Lang;
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
                $form->addTabFields($fields);
            }
        });
    }

    public function boot()
    {
        Event::listen('cms.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addCss('/plugins/eev/core/assets/css/core.min.css');
            $controller->addJs('/plugins/eev/core/assets/js/core.min.js');
        });

        Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addCss('/plugins/eev/core/assets/css/admin.min.css');
        });

        Event::listen('eev.core.inlineStyles', function ($styles) {
            $themeStylesManager = new ThemeStyles();

            return array_merge($styles, $themeStylesManager->getStyles());
        });

        Validator::extend('recaptcha', ReCaptcha::class);

        parent::boot();
    }

    public function registerComponents()
    {
        return [
            InlineStyles::class => 'inlineStyles',
            Breadcrumbs::class  => 'breadcrumbs',
            Contact::class      => 'contact',
            Address::class      => 'address',
            Socials::class      => 'socials',
            OpeningHours::class => 'opening_hours',
            Logo::class         => 'logo',
            Widget::class       => 'widget',
            Form::class         => 'form',
            Popup::class        => 'popup',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'eev.core::lang.company_settings',
                'description' => '',
                'category'    => 'eev.core::lang.company',
                'class'       => Settings::class,
                'icon'        => 'icon-globe',
                'order'       => 500,
                'keywords'    => ''
            ]
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'trans' => [$this, 'getTranslate']
            ],
        ];
    }

    public function getTranslate($message, $variables = [])
    {
        return Lang::get($message, $variables);
    }

}