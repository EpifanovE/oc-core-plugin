<?php

namespace DigitFab\Core\Classes\Widgets\Types;

use DigitFab\Core\Models\WorkingPeriod;
use Illuminate\Support\Facades\Lang;

class OpeningHours extends WidgetType
{
    protected $name = self::OPENING_HOURS;

    protected $periods;

    protected function setData()
    {

        $this->periods = WorkingPeriod::orderBy('sort_order', 'ASC')->get();

        $this->data['classes'] = 'IconBox';
        $this->data['content'] = $this->getRows();
        $this->data['title'] = $this->getTitle();
    }

    protected function getFields()
    {
        return [
            'short_days' => [
                'label'       => Lang::get('digitfab.core::lang.short_days'),
                'description' => '',
                'default'     => false,
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-12',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'title'  => [
                'label'       => Lang::get('digitfab.core::lang.title'),
                'description' => '',
                'type'        => 'text',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-12',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'show_title'  => [
                'label'       => Lang::get('digitfab.core::lang.show_title'),
                'description' => '',
                'default'     => false,
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-12',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'show_icon'  => [
                'label'       => Lang::get('digitfab.core::lang.show_icon'),
                'description' => '',
                'default'     => true,
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-12',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
            'microdata'  => [
                'label'       => Lang::get('digitfab.core::lang.microdata'),
                'description' => '',
                'default'     => '',
                'type'        => 'checkbox',
                'span'        => 'storm',
                'cssClass'    => 'col-sm-12',
                'tab'         => Lang::get('digitfab.core::lang.adv_settings'),
            ],
        ];
    }

    protected function getTitle() {
        if (!empty($this->data['title'])) {
            return $this->data['title'];
        }

        return Lang::get('digitfab.core::lang.opening_hours');
    }

    protected function getDayLabel($day)
    {
        $length = empty($this->data['short_days']) ? 'normal' : 'short';

        return Lang::get("digitfab.core::lang.working_days.{$length}.${day}");
    }

    protected function getRows()
    {
        $result = '';

        foreach ($this->convert() as $day => $item) :
            $result .= '<li class="OpeningHours__Item">';

            if ( ! empty($this->data['microdata'])) {
                $result .= $this->getSchema($day, $item);
            }

            $result .= "<span class='OpeningHours__Day'>{$this->getDayLabel($day)}</span>";

            if ($item['around_the_clock']) {
                $result .= "<span class='OpeningHours__Time OpeningHours__Time_around'>" . trans("digitfab.core::lang.around_the_clock") . "</span>";
                $result .= "</li>";
                continue;
            }

            $result .= '<span class="OpeningHours__Periods">';
            foreach ($item['times'] as $key => $time) :
                $result .= '<span class="OpeningHours__Period">';

                $result .= '<time class="OpeningHours__Time OpeningHours__Time_from" datetime="'
                           . $time['time_from'] . '">' . $time['time_from'] . '</time>';
                $result .= '-';
                $result .= '<time class="OpeningHours__Time OpeningHours__Time_till" datetime="'
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

    protected function convert()
    {
        $result = [];

        foreach ($this->periods as $period) :
            $result[$period->day]['around_the_clock'] = $period->around_the_clock;
            $result[$period->day]['times'][]          = [
                'time_from' => ( ! empty($period->time_from)) ? $period->time_from : null,
                'time_till' => ( ! empty($period->time_till)) ? $period->time_till : null,
            ];

        endforeach;

        return $result;
    }

    protected function getSchema($day, $item)
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
}
