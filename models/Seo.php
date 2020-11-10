<?php

namespace DigitFab\Core\Models;

use Model;
use October\Rain\Database\Traits\Validation;

class Seo extends Model
{
    use Validation;

    public $timestamps = false;

    public $table = 'digitfab_core_seos';

    public $rules = [
        'title' => [
            'string',
            'nullable',
            'max:1024',
        ],
        'description' => [
            'string',
            'nullable',
            'max:2048',
        ],
        'keywords' => [
            'string',
            'nullable',
            'max:1024',
        ],
        'indexing' => [
            'boolean',
            'nullable',
        ],
    ];
}
