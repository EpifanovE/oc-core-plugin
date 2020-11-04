<?php

namespace DigitFab\Core\Classes\Forms\Fields\Types;

class Text extends FieldType
{
    public function classes()
    {
        $parentClasses = $this->field->classes();

        $classes = [
            'form-field_text',
        ];

        return $parentClasses . ' ' . join(' ', $classes);

    }
}