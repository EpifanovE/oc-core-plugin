<?php

namespace EEV\Core\Classes\Company;

class ContactType
{
    public static function get()
    {
        return [
            'none'  => 'eev.core::lang.not_defined',
            'phone' => 'eev.core::lang.phone',
            'email' => 'eev.core::lang.email',
            'fax'   => 'eev.core::lang.fax',
            'skype'   => 'eev.core::lang.skype',
            'viber'   => 'eev.core::lang.viber',
            'telegram'   => 'eev.core::lang.telegram',
            'WhatsApp'   => 'eev.core::lang.whatsapp',
        ];
    }
}