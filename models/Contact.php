<?php

namespace EEV\Core\Models;

use EEV\Core\Classes\Company\ContactType;
use Model;

/**
 * Model
 */
class Contact extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $timestamps = false;

    public $table = 'eev_core_contacts';

    public $rules = [
    ];

    public function getTypeOptions()
    {
        return ContactType::get();
    }

    public function getTypeNameAttribute()
    {
        if (isset(ContactType::get()[$this->type])) {
            return trans(ContactType::get()[$this->type]);
        }
        return $this->type;
    }
}
