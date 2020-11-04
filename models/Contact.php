<?php

namespace DigitFab\Core\Models;

use DigitFab\Core\Classes\Company\ContactType;
use Model;

/**
 * Model
 */
class Contact extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $timestamps = false;

    public $table = 'digitfab_core_contacts';

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
