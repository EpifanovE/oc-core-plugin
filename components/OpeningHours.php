<?php

namespace DigitFab\Core\Components;

use Cms\Classes\ComponentBase;
use DigitFab\Core\Classes\Company\WorkingPeriodData;
use DigitFab\Core\Models\WorkingPeriod;

class OpeningHours extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'digitfab.core::lang.components.opening-hours.name',
            'description' => 'digitfab.core::lang.components.opening-hours.desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'short_days'      => [
                'title'             => 'digitfab.core::lang.short_days',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'show_icon'      => [
                'title'             => 'digitfab.core::lang.show_icon',
                'description'       => '',
                'default'           => false,
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'microdata'      => [
                'title'             => 'digitfab.core::lang.microdata',
                'description'       => '',
                'default'           => '',
                'type'              => 'checkbox',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
            'adv_class'      => [
                'title'             => 'digitfab.core::lang.adv_class',
                'description'       => '',
                'default'           => '',
                'type'              => 'string',
                'showExternalParam' => false,
                'group'             => 'digitfab.core::lang.params',
            ],
        ];
    }

    public function periods() {
        return WorkingPeriod::orderBy('sort_order', 'ASC')->get();
    }

    private function getDayLabel($day) {
        $length = empty($this->property('short_days')) ? 'normal' : 'short';

        $days = WorkingPeriodData::getDays($length);

        if (isset($days[$day])) {
            return $days[$day];
        }

        return '';
    }

    public function getRows()
    {
        $result = '';

        foreach ($this->convert() as $day => $item) :
            $result .= '<li class="opening-hours__item">';

            if ($this->property('microdata')) {
                $result .= $this->getSchema($day, $item);
            }

            $result .= "<span class='opening-hours__day'>{$this->getDayLabel($day)}</span>";

            if ($item['around_the_clock']) {
                $result .= "<span class='opening-hours__time opening-hours__time_around'>" . trans("digitfab.core::lang.around_the_clock") . "</span>";
                $result .= "</li>";
                continue;
            }

            $result .= '<span class="opening-hours__periods">';
            foreach ($item['times'] as $key => $time) :
                $result .= '<span class="opening-hours__period">';

                $result .= '<time class="opening-hours__time opening-hours__time_from" datetime="'
                           . $time['time_from'] . '">' . $time['time_from'] . '</time>';
                $result .= '-';
                $result .= '<time class="opening-hours__time opening-hours__time_till" datetime="'
                           . $time['time_till'] . '">' . $time['time_till'] . '</time>';
                $result .= ($key < (count($item['times']) - 1)) ? ', ' : '';

                $result .= '</span>';
            endforeach;
            $result .= '</span>';

            $result = trim($result, ', ');

            $result .= '</li>';
        endforeach;

        return $result;
    }

//    public function getJsonld()
//    {
//        if (empty($this->items)) {
//            return '';
//        }
//
//        $result = '';
//
//        $result .= '"openingHours":[';
//
//        foreach ($this->items as $item) :
//
//            $result .= '"' . esc_html($item['day']) . ' ';
//
//            if (!empty($item['around_the_clock']) && $item['around_the_clock'] == true) :
//                $result = trim($result);
//                $result .= '",';
//                continue;
//            endif;
//
//            $result .= esc_html($item['time_from']) . '-' . esc_html($item['time_till']) . '",';
//
//        endforeach;
//        $result = trim($result, ',');
//        $result .= ']';
//
//        return $result;
//    }


    private function convert()
    {
        $result = [];

        foreach ($this->periods() as $period) :
            $result[$period->day]['around_the_clock'] = $period->around_the_clock;
            $result[$period->day]['times'][] = [
                'time_from' => (!empty($period->time_from)) ? $period->time_from : null,
                'time_till' => (!empty($period->time_till)) ? $period->time_till : null,
            ];

        endforeach;

        return $result;
    }

    private function getSchema($day, $item)
    {
        $result = '';

        if ($item['around_the_clock'] !== false) :

            $result .= '<meta itemprop="openingHours" content="' . $day . '"/>';

            return $result;
        endif;

        foreach ($item['times'] as $time) :
            $result .= '<meta itemprop="openingHours" content="' . $day . ' ';

            $result .= $time['time_from'] . '-' . $time['time_till'];
            $result .= '"/>';
        endforeach;

        return $result;
    }

    public function classes()
    {
        $classes = [
            'opening-hours',
        ];

        return join(' ', $classes) . (( ! empty($this->property('adv_class')))
                ? ' ' . $this->property('adv_class')
                : '');
    }

}
