<?php

namespace EEV\Core\Classes\Company;

class SocialType
{

    public static function listAll() {
        $result = [];

        foreach (self::all() as $key => $item) {
            $result[$key] = $item['label'];
        }

        return $result;
    }

    public static function all() {
        return [
            'none' => [
                'label' => 'eev.core::lang.none',
            ],
            'vk' => [
                'label' => 'eev.core::lang.socials.vk',
                'icon-class' => 'fab fa-vk',
            ],
            'ok' => [
                'label' => 'eev.core::lang.socials.ok',
                'icon-class' => 'fab fa-odnoklassniki',
            ],
            'facebook' => [
                'label' => 'eev.core::lang.socials.facebook',
                'icon-class' => 'fab fa-facebook',
            ],
            'instagram' => [
                'label' => 'eev.core::lang.socials.instagram',
                'icon-class' => 'fab fa-instagram',
            ],
            'pinterest' => [
                'label' => 'eev.core::lang.socials.pinterest',
                'icon-class' => 'fab fa-pinterest',
            ],
            'twitter' => [
                'label' => 'eev.core::lang.socials.twitter',
                'icon-class' => 'fab fa-twitter',
            ],
            'youtube' => [
                'label' => 'eev.core::lang.socials.youtube',
                'icon-class' => 'fab fa-youtube',
            ],
        ];
    }

}