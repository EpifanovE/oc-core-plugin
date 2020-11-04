<?php

namespace DigitFab\Core\Updates;

use DigitFab\Core\Classes\Company\ContactType;
use DigitFab\Core\Classes\Company\SocialType;
use DigitFab\Core\Classes\Company\WorkingPeriodData;
use DigitFab\Core\Classes\Widgets\Types\WidgetType;
use DigitFab\Core\Models\Address;
use DigitFab\Core\Models\Contact;
use DigitFab\Core\Models\Social;
use DigitFab\Core\Models\Widget;
use DigitFab\Core\Models\WorkingPeriod;
use October\Rain\Database\Updates\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Contact::create([
            'title' => '8 (906) 333-44-55',
            'text' => 'без выходных',
            'link' => 'tel:+79063334455',
            'type' => ContactType::PHONE,
        ]);

        Contact::create([
            'title' => 'email@gmail.com',
            'text' => '',
            'link' => 'mailto:email@gmail.com',
            'type' => ContactType::EMAIL,
        ]);

        Address::create([
            'name' => 'Главный офис',
            'country' => 'Россия',
            'locality' => 'Йошкар-Ола',
            'region' => 'Марий Эл',
            'postal_code' => '424000',
            'street_address' => 'ул. Красноармейская, д.47, оф.317',
            'latitude' => '56.640906',
            'longitude' => '47.892458',
        ]);

        Social::create([
            'title' => 'Вконтакте',
            'type' => SocialType::VK,
            'link' => '#',
            'is_active' => true,
        ]);

        Social::create([
            'title' => 'Одноклассники',
            'type' => SocialType::OK,
            'link' => '#',
            'is_active' => true,
        ]);

        Social::create([
            'title' => 'Facebook',
            'type' => SocialType::FACEBOOK,
            'link' => '#',
            'is_active' => true,
        ]);

        Social::create([
            'title' => 'Twitter',
            'type' => SocialType::TWITTER,
            'link' => '#',
            'is_active' => true,
        ]);

        Social::create([
            'title' => 'Youtube',
            'type' => SocialType::YOUTUBE,
            'link' => '#',
            'is_active' => true,
        ]);

        WorkingPeriod::create([
            'day' => WorkingPeriodData::MONDAY_FRIDAY,
            'time_from' => '8:00',
            'time_till' => '12:00',
            'around_the_clock' => false,
        ]);

        WorkingPeriod::create([
            'day' => WorkingPeriodData::MONDAY_FRIDAY,
            'time_from' => '13:00',
            'time_till' => '18:00',
            'around_the_clock' => false,
        ]);

        WorkingPeriod::create([
            'day' => WorkingPeriodData::SATURDAY_SUNDAY,
            'time_from' => '9:00',
            'time_till' => '15:00',
            'around_the_clock' => false,
        ]);

        Widget::create([
            'name' => 'Промо-секция - Главная страница',
            'type' => WidgetType::HERO,
            'data' => [
                'slides' => [
                    [
                        'title' => '<strong>Отделка помещений</strong><br>в Нижнем Новгороде и области',
                        'text' => '<p>Внутренняя отделка квартир – важнейшая часть ремонта, а выбор поставщика таких услуг – непростая и ответственная задача. От квалификации мастеров зависит внешний вид отремонтированного жилья, уровень комфорта.</p>',
                        'button_text' => 'Узнать подробнее',
                    ],
                    [
                        'title' => '<strong>Отделка помещений</strong><br>в Москве и области',
                        'text' => '<p>Внутренняя отделка квартир – важнейшая часть ремонта, а выбор поставщика таких услуг – непростая и ответственная задача. От квалификации мастеров зависит внешний вид отремонтированного жилья, уровень комфорта.</p>',
                        'button_text' => 'Узнать подробнее',
                    ]
                ],
            ],
        ]);

        Widget::create([
            'name' => 'О компании - Главная страница',
            'type' => WidgetType::ABOUT,
            'data' => [
                "desc" => "<p>Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана.</p><p>Маленький ручеек Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот.</p><p>Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни.</p>",
                "title" => "О компании",
                "button_link" => "/about",
                "button_text" => "Подробнее",
                "button_class" => ""
            ],
        ]);

        Widget::create([
            'name' => 'Наши преимущества - Главная страница',
            'type' => WidgetType::ICONCARD,
            'data' => [
                "title" => "Наши преимущества",
                "subtitle" => "Далеко-далеко за словесными горами в стране гласных и согласных",
                "button_link" => "/about",
                "button_text" => "Подробнее",
                "button_class" => "",
                "elements" => [
                    [
                        'title' => '24 часа в сутки',
                        'text' => 'Далеко-далеко за словесными горами в стране гласных и согласных',
                        'icon_class' => 'fas fa-phone',
                    ],
                    [
                        'title' => 'Гарантия качества',
                        'text' => 'Далеко-далеко за словесными горами в стране гласных и согласных в стране гласных и согласных',
                        'icon_class' => 'fas fa-user',
                        'link' => '#',
                    ],
                ],
            ],
        ]);

        \DB::table('system_settings')->insert([
            [
                'item' => 'digitfab_core_settings',
                'value' => json_encode([
                    'name' => 'ООО "Сантехремстроймонтаж"',
                    'short_desc' => 'Отделка помещений под ключ',
                ]),
            ],
        ]);
    }
}