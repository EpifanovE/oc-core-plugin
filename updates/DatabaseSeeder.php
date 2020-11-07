<?php

namespace DigitFab\Core\Updates;

use DigitFab\Core\Classes\Company\ContactType;
use DigitFab\Core\Classes\Company\SocialType;
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
            'title' => 'Телефон',
            'text' => '8 (906) 333-44-55',
            'link' => 'tel:+79063334455',
            'type' => ContactType::PHONE,
        ]);

        Contact::create([
            'title' => 'Мобильный телефон',
            'text' => '8 (906) 333-44-55',
            'link' => 'tel:+79063334455',
            'type' => ContactType::PHONE,
        ]);

        Contact::create([
            'title' => 'Электронная почта',
            'text' => 'email@gmail.com',
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
            'day' => WorkingPeriod::MONDAY_FRIDAY,
            'time_from' => '8:00',
            'time_till' => '12:00',
            'around_the_clock' => false,
        ]);

        WorkingPeriod::create([
            'day' => WorkingPeriod::MONDAY_FRIDAY,
            'time_from' => '13:00',
            'time_till' => '18:00',
            'around_the_clock' => false,
        ]);

        WorkingPeriod::create([
            'day' => WorkingPeriod::SATURDAY_SUNDAY,
            'time_from' => '9:00',
            'time_till' => '15:00',
            'around_the_clock' => false,
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Телефон верх',
            'type' => WidgetType::CONTACT,
            'area' => 'top-bar-left',
            'data' => json_encode([
                'contact' => 1,
                'contact_as_title' => true,
                'title_as_link' => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Электронная почта верх',
            'type' => WidgetType::CONTACT,
            'area' => 'top-bar-center',
            'data' => json_encode([
                'contact' => 3,
                'contact_as_title' => true,
                'title_as_link' => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Телефон подвал',
            'type' => WidgetType::CONTACT,
            'area' => 'footer-contacts-right',
            'data' => json_encode([
                'contact' => 1,
                'text_as_link' => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Мобильный подвал',
            'type' => WidgetType::CONTACT,
            'area' => 'footer-contacts-right',
            'data' => json_encode([
                'contact' => 2,
                'text_as_link' => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Адрес подвал',
            'type' => WidgetType::ADDRESS,
            'area' => 'footer-contacts-left',
            'data' => json_encode([
                'address' => 1,
                'show_title' => true,
                'show_icon' => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Режим подвал',
            'type' => WidgetType::OPENING_HOURS,
            'area' => 'footer-contacts-left',
            'data' => json_encode([
                'show_title' => true,
                'show_icon' => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Электронная почта подвал',
            'type' => WidgetType::CONTACT,
            'area' => 'footer-contacts-center',
            'data' => json_encode([
                'contact' => 3,
                'text_as_link' => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Кнопка подвал',
            'type' => WidgetType::CODE,
            'area' => 'footer-contacts-right',
            'data' => json_encode([
                'content' => "<a class=\"Button Button_ctaInverse Button_inverse FooterContacts__Item\" data-popup=\"callback-popup\" href=\"#callback-popup\">Заказать звонок</a>",
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Социальные сети подвал',
            'type' => WidgetType::SOCIALS,
            'area' => 'footer-left',
            'data' => json_encode([]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Текст подвал',
            'type' => WidgetType::CODE,
            'area' => 'footer-right',
            'data' => json_encode([
                'content' => "<span class=\"Footer__Copy\">© 2020 localhost - Бухгалтеские услуги.</span><span class=\"Footer__Vendor\"><a href=\"#\">Разработка сайтов</a> в DigitFab.ru</span>"
            ]),
        ]);

//        Widget::create([
//            'name' => 'Промо-секция - Главная страница',
//            'type' => WidgetType::HERO,
//            'area' => 'home',
//            'data' => [
//                'slides' => [
//                    [
//                        'title' => '<strong>Отделка помещений</strong><br>в Нижнем Новгороде и области',
//                        'text' => '<p>Внутренняя отделка квартир – важнейшая часть ремонта, а выбор поставщика таких услуг – непростая и ответственная задача. От квалификации мастеров зависит внешний вид отремонтированного жилья, уровень комфорта.</p>',
//                        'button_text' => 'Узнать подробнее',
//                    ],
//                    [
//                        'title' => '<strong>Отделка помещений</strong><br>в Москве и области',
//                        'text' => '<p>Внутренняя отделка квартир – важнейшая часть ремонта, а выбор поставщика таких услуг – непростая и ответственная задача. От квалификации мастеров зависит внешний вид отремонтированного жилья, уровень комфорта.</p>',
//                        'button_text' => 'Узнать подробнее',
//                    ]
//                ],
//            ],
//        ]);
//
//        Widget::create([
//            'name' => 'О компании - Главная страница',
//            'type' => WidgetType::ABOUT,
//            'area' => 'home',
//            'data' => [
//                "desc" => "<p>Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана.</p><p>Маленький ручеек Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот.</p><p>Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни.</p>",
//                "title" => "О компании",
//                "button_link" => "/about",
//                "button_text" => "Подробнее",
//                "button_class" => ""
//            ],
//        ]);
//
//        Widget::create([
//            'name' => 'Наши преимущества - Главная страница',
//            'type' => WidgetType::ICONCARD,
//            'area' => 'home',
//            'data' => [
//                "title" => "Наши преимущества",
//                "subtitle" => "Далеко-далеко за словесными горами в стране гласных и согласных",
//                "button_link" => "/about",
//                "button_text" => "Подробнее",
//                "button_class" => "",
//                "elements" => [
//                    [
//                        'title' => '24 часа в сутки',
//                        'text' => 'Далеко-далеко за словесными горами в стране гласных и согласных',
//                        'icon_class' => 'fas fa-phone',
//                    ],
//                    [
//                        'title' => 'Гарантия качества',
//                        'text' => 'Далеко-далеко за словесными горами в стране гласных и согласных в стране гласных и согласных',
//                        'icon_class' => 'fas fa-user',
//                        'link' => '#',
//                    ],
//                ],
//            ],
//        ]);

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
