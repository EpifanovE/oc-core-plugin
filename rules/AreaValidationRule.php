<?php

namespace DigitFab\Core\Rules;

use DigitFab\Core\Classes\Widgets\AreasManager;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

class AreaValidationRule implements Rule
{
    public function passes($attribute, $value)
    {
        $areasManager = new AreasManager();
        $areas = $areasManager->getAreasList();

        return array_key_exists($value, $areas);
    }

    public function validate($attribute, $value, $params)
    {
        return $this->passes($attribute, $value);
    }

    public function message()
    {
        return Lang::get('digitfab.core::validation.invalid_widget_area');
    }
}