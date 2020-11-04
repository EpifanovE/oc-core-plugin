<?php

namespace DigitFab\Core;

use Backend\Widgets\Form;
use DigitFab\Core\Classes\Forms\Rules\ReCaptcha;
use DigitFab\Core\Components\Address;
use DigitFab\Core\Components\Breadcrumbs;
use DigitFab\Core\Components\Contact;
use DigitFab\Core\Components\InlineStyles;
use DigitFab\Core\Components\Logo;
use DigitFab\Core\Components\OpeningHours;
use DigitFab\Core\Components\Popup;
use DigitFab\Core\Components\Socials;
use DigitFab\Core\Components\Widget;
use DigitFab\Core\Components\Form as FormComponent;
use DigitFab\Core\Controllers\WidgetController;
use DigitFab\Core\Models\FrontPage;
use DigitFab\Core\Models\Settings;
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
                if (!$form->isNested) {
                    $form->addTabFields($fields);
                }
            }
        });
    }

    public function boot()
    {
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
            FormComponent::class         => 'form',
            Popup::class        => 'popup',
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
            'filters' => [
                'trans' => [$this, 'getTranslate'],
            ],
        ];
    }

    public function getTranslate($message, $variables = [])
    {
        return Lang::get($message, $variables);
    }

}