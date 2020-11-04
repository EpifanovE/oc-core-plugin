<?php

namespace DigitFab\Core\Classes\Company;

class SocialType
{
    const NONE = 'none';
    const VK = 'vk';
    const OK = 'ok';
    const FACEBOOK = 'facebook';
    const INSTAGRAM = 'instagram';
    const PINTEREST = 'pinterest';
    const TWITTER = 'twitter';
    const YOUTUBE = 'youtube';

    public static function listAll() {
        $result = [];

        foreach (self::all() as $key => $item) {
            $result[$key] = $item['label'];
        }

        return $result;
    }

    public static function all() {
        return [
            self::NONE => [
                'label' => 'digitfab.core::lang.none',
            ],
            self::VK => [
                'label' => 'digitfab.core::lang.socials.vk',
                'icon-class' => 'fab fa-vk',
            ],
            self::OK => [
                'label' => 'digitfab.core::lang.socials.ok',
                'icon-class' => 'fab fa-odnoklassniki',
            ],
            self::FACEBOOK => [
                'label' => 'digitfab.core::lang.socials.facebook',
                'icon-class' => 'fab fa-facebook',
            ],
            self::INSTAGRAM => [
                'label' => 'digitfab.core::lang.socials.instagram',
                'icon-class' => 'fab fa-instagram',
            ],
            self::PINTEREST => [
                'label' => 'digitfab.core::lang.socials.pinterest',
                'icon-class' => 'fab fa-pinterest',
            ],
            self::TWITTER => [
                'label' => 'digitfab.core::lang.socials.twitter',
                'icon-class' => 'fab fa-twitter',
            ],
            self::YOUTUBE => [
                'label' => 'digitfab.core::lang.socials.youtube',
                'icon-class' => 'fab fa-youtube',
            ],
        ];
    }

}