<?php

namespace EEV\Core\Classes\Forms\Fields\Types;

class Password extends FieldType
{
    public function getTemplateName() {
        return 'text';
    }

    public function classes()
    {
        $parentClasses = $this->field->classes();

        $classes = [
            'form-field_password',
        ];

        return $parentClasses . ' ' . join(' ', $classes);

    }
}