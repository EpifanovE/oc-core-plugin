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
            'text'  => '8 (906) 333-44-55',
            'link'  => 'tel:+79063334455',
            'type'  => ContactType::PHONE,
        ]);

        Contact::create([
            'title' => 'Мобильный телефон',
            'text'  => '8 (906) 333-44-55',
            'link'  => 'tel:+79063334455',
            'type'  => ContactType::PHONE,
        ]);

        Contact::create([
            'title' => 'Электронная почта',
            'text'  => 'email@gmail.com',
            'link'  => 'mailto:email@gmail.com',
            'type'  => ContactType::EMAIL,
        ]);

        Address::create([
            'name'           => 'Главный офис',
            'country'        => 'Россия',
            'locality'       => 'Йошкар-Ола',
            'region'         => 'Марий Эл',
            'postal_code'    => '424000',
            'street_address' => 'ул. Красноармейская, д.47, оф.317',
            'latitude'       => '56.640906',
            'longitude'      => '47.892458',
        ]);

        Social::create([
            'title'     => 'Вконтакте',
            'type'      => SocialType::VK,
            'link'      => '#',
            'is_active' => true,
        ]);

        Social::create([
            'title'     => 'Одноклассники',
            'type'      => SocialType::OK,
            'link'      => '#',
            'is_active' => true,
        ]);

        Social::create([
            'title'     => 'Facebook',
            'type'      => SocialType::FACEBOOK,
            'link'      => '#',
            'is_active' => true,
        ]);

        Social::create([
            'title'     => 'Twitter',
            'type'      => SocialType::TWITTER,
            'link'      => '#',
            'is_active' => true,
        ]);

        Social::create([
            'title'     => 'Youtube',
            'type'      => SocialType::YOUTUBE,
            'link'      => '#',
            'is_active' => true,
        ]);

        WorkingPeriod::create([
            'day'              => WorkingPeriod::MONDAY_FRIDAY,
            'time_from'        => '8:00',
            'time_till'        => '12:00',
            'around_the_clock' => false,
        ]);

        WorkingPeriod::create([
            'day'              => WorkingPeriod::MONDAY_FRIDAY,
            'time_from'        => '13:00',
            'time_till'        => '18:00',
            'around_the_clock' => false,
        ]);

        WorkingPeriod::create([
            'day'              => WorkingPeriod::SATURDAY_SUNDAY,
            'time_from'        => '9:00',
            'time_till'        => '15:00',
            'around_the_clock' => false,
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Телефон верх',
            'type' => WidgetType::CONTACT,
            'area' => 'top-bar-left',
            'data' => json_encode([
                'contact'          => 1,
                'contact_as_title' => true,
                'title_as_link'    => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Электронная почта верх',
            'type' => WidgetType::CONTACT,
            'area' => 'top-bar-center',
            'data' => json_encode([
                'contact'          => 3,
                'contact_as_title' => true,
                'title_as_link'    => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Телефон подвал',
            'type' => WidgetType::CONTACT,
            'area' => 'footer-contacts-right',
            'data' => json_encode([
                'contact'      => 1,
                'text_as_link' => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Мобильный подвал',
            'type' => WidgetType::CONTACT,
            'area' => 'footer-contacts-right',
            'data' => json_encode([
                'contact'      => 2,
                'text_as_link' => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Адрес подвал',
            'type' => WidgetType::ADDRESS,
            'area' => 'footer-contacts-left',
            'data' => json_encode([
                'address'    => 1,
                'show_title' => true,
                'show_icon'  => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Режим подвал',
            'type' => WidgetType::OPENING_HOURS,
            'area' => 'footer-contacts-left',
            'data' => json_encode([
                'show_title' => true,
                'show_icon'  => true,
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Электронная почта подвал',
            'type' => WidgetType::CONTACT,
            'area' => 'footer-contacts-center',
            'data' => json_encode([
                'contact'      => 3,
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
            'name' => 'Кнопка в шапке',
            'type' => WidgetType::CODE,
            'area' => 'top-bar-right',
            'data' => json_encode([
                'content' => "<a class=\"Button Button_ctaInverse Button_inverse Button_size_sm FooterContacts__Item\" data-popup=\"callback-popup\" href=\"#callback-popup\">Заказать звонок</a>",
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

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Промо-секция - Главная страница',
            'type' => WidgetType::HERO,
            'area' => 'home',
            'data' => json_encode([
                "text"        => "<p>Задача организации, в особенности же укрепление и развитие структуры позволяет выполнять важные задания по разработке форм развития. Задача организации, в особенности же новая модель.</p>\r\n",
                "title"       => "Бухгалтерские услуги<br><strong>в Москве и Московской области</strong>",
                "button_text" => "Получить консультацию",
                "full_height" => "0",
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'О компании - Главная страница',
            'type' => WidgetType::ABOUT,
            'area' => 'home',
            'data' => json_encode([
                "title"    => "О компании",
                "images"   => [
                    [
                        "alt" => "Задача организации, в особенности",
                        "src" => "/about-1.jpg",
                    ],
                    [
                        "alt" => "",
                        "src" => "/about-2.jpg",
                    ],
                    [
                        "alt" => "Задача организации, в особенности",
                        "src" => "/about-3.jpg",
                    ],
                ],
                "content"  => "<p>Задача организации, в особенности же укрепление и развитие структуры позволяет выполнять важные задания по разработке форм развития. Задача организации, в особенности же новая модель. Задача организации, в особенности же укрепление и развитие структуры позволяет выполнять важные задания по разработке форм развития. Задача организации, в особенности же новая модель.</p>\r\n\r\n<p>Задача организации, в особенности же укрепление и развитие структуры позволяет выполнять важные задания по разработке форм развития. Задача организации, в особенности же новая модель. Задача организации, в особенности же укрепление и развитие структуры позволяет выполнять важные задания по разработке форм развития. Задача организации, в особенности же новая модель.</p>",
                "subtitle" => "информация"
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'Наши преимущества - Главная страница',
            'type' => WidgetType::ICONCARD,
            'area' => 'home',
            'data' => json_encode([
                "title"    => "Наши преимущества",
                "subtitle" => "Далеко-далеко за словесными горами в стране гласных и согласных",
                "elements" => [
                    [
                        "link"=> "#",
                        "text"=> "Задача организации, в особенности же укрепление и развитие структуры позволяет выполнять важные задания",
                        "image"=> "/logo-example.png", "title"=> "Задача организации, в особенности",
                        "icon_class"=> ""
                    ],
                    [
                        "link"=> "",
                        "text"=> "Задача организации, в особенности же укрепление и развитие структуры позволяет выполнять важные задания",
                        "image"=> "/about-2.jpg",
                        "title"=> "Задача организации, в особенности",
                        "icon_class"=> ""
                    ],
                    [
                        "link"=> "",
                        "text"=> "Задача организации, в особенности же укрепление и развитие структуры позволяет выполнять важные задания",
                        "image"=> "",
                        "title"=> "Задача организации",
                        "icon_class"=> "fas fa-anchor"
                    ],
                    [
                        "link"=> "#",
                        "text"=> "Задача организации, в особенности же укрепление и развитие структуры позволяет выполнять важные задания",
                        "image"=> "",
                        "title"=> "Задача организации, в особенности",
                        "icon_class"=> ""
                    ],
                    [
                        "link"=> "",
                        "text"=> "Задача организации, в особенности же укрепление и развитие структуры позволяет выполнять важные задания",
                        "image"=> "",
                        "title"=> "Задача организации",
                        "icon_class"=> "fas fa-balance-scale"
                    ],
                    [
                        "link"=> "",
                        "text"=> "Задача организации, в особенности же укрепление и развитие структуры позволяет выполнять важные задания",
                        "image"=> "",
                        "title"=> "Задача организации",
                        "icon_class"=> "fas fa-award"
                    ],
                ],
            ]),
        ]);

        \DB::table('digitfab_core_widgets')->insert([
            'name' => 'CTA-секция - Главная страница',
            'type' => WidgetType::CTA,
            'area' => 'home',
            'data' => json_encode([
                "title" => "У вас есть вопросы?",
                "content" => "<p>Задача организации, в особенности же укрепление и развитие структуры позволяет выполнять важные задания по разработке форм развития. Задача организации, в особенности же новая модель организационной деятельности обеспечивает широкому кругу (специалистов) участие в формировании дальнейших направлений развития.</p>",
                "button_text" => "Узнать подробнее",
                "background_image" => "/blog-3.jpg",
            ]),
        ]);

        \DB::table('system_settings')->insert([
            [
                'item'  => 'digitfab_core_settings',
                'value' => json_encode([
                    'name'       => 'ООО "Сантехремстроймонтаж"',
                    'short_desc' => 'Отделка помещений под ключ',
                ]),
            ],
        ]);
    }
}
