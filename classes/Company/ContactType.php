<?php

namespace EEV\Core\Classes\Company;

class ContactType
{
    const NONE = 'none';
    const PHONE = 'phone';
    const EMAIL = 'email';
    const FAX = 'fax';
    const SKYPE = 'skype';
    const VIBER = 'viber';
    const TELEGRAM = 'telegram';
    const WHATSAPP = 'WhatsApp';

    public static function get()
    {
        return [
            self::NONE  => 'eev.core::lang.not_defined',
            self::PHONE => 'eev.core::lang.phone',
            self::EMAIL => 'eev.core::lang.email',
            self::FAX   => 'eev.core::lang.fax',
            self::SKYPE   => 'eev.core::lang.skype',
            self::VIBER   => 'eev.core::lang.viber',
            self::TELEGRAM   => 'eev.core::lang.telegram',
            self::WHATSAPP   => 'eev.core::lang.whatsapp',
        ];
    }
}