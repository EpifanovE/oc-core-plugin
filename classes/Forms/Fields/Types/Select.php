<?php

namespace EEV\Core\Classes\Forms\Fields\Types;

class Select extends FieldType
{
    public function getTemplateName() {
        return 'select';
    }

    public function classes()
    {
        $parentClasses = $this->field->classes();

        $classes = [
            'form-field_select',
        ];

        return $parentClasses . ' ' . join(' ', $classes);

    }
}