<?php

namespace EEV\Core\Classes\Forms\Fields\Types;

class Number extends FieldType
{
    public function getTemplateName() {
        return 'text';
    }

    public function classes()
    {
        $parentClasses = $this->field->classes();

        $classes = [
            'form-field_number',
        ];

        return $parentClasses . ' ' . join(' ', $classes);

    }
}