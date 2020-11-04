<?php

namespace DigitFab\Core\Classes\Company;

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
            self::NONE  => 'digitfab.core::lang.not_defined',
            self::PHONE => 'digitfab.core::lang.phone',
            self::EMAIL => 'digitfab.core::lang.email',
            self::FAX   => 'digitfab.core::lang.fax',
            self::SKYPE   => 'digitfab.core::lang.skype',
            self::VIBER   => 'digitfab.core::lang.viber',
            self::TELEGRAM   => 'digitfab.core::lang.telegram',
            self::WHATSAPP   => 'digitfab.core::lang.whatsapp',
        ];
    }
}