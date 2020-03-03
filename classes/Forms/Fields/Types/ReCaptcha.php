<?php

namespace EEV\Core\Classes\Forms\Fields\Types;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class ReCaptcha extends FieldType
{
    public function getTemplateName() {
        return 'recaptcha';
    }

    public function classes()
    {
        $parentClasses = $this->field->classes();

        $classes = [
            'form-field_recaptcha',
        ];

        return $parentClasses . ' ' . join(' ', $classes);

    }

    public function getVars() {
        return [
            'site_key' => Config::get('eev.core::recaptcha.site_key'),
        ];
    }

    public function getHtml()
    {
        if (!\config('eev.core::recaptcha.secret_key') || !\config('eev.core::recaptcha.site_key')) {
            return Lang::get('eev.core::lang.recaptcha_is_not_defined');
        }

        return parent::getHtml();
    }
}