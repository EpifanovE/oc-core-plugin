<?php


namespace EEV\Core\Classes\Company;


class WorkingPeriodData
{
    const MONDAY_SUNDAY = 'Mo-Su';
    const MONDAY_FRIDAY= 'Mo-Fr';
    const MONDAY = 'Mo';
    const TUESDAY = 'Tu';
    const WEDNESDAY = 'We';
    const THURSDAY = 'Th';
    const FRIDAY = 'Fr';
    const SATURDAY_SUNDAY  = 'Sa-Su';
    const SATURDAY  = 'Sa';
    const SUNDAY  = 'Su';

    public static function getDays($length = 'normal') {
        return [
            self::MONDAY_SUNDAY => trans("eev.core::lang.working_days.{$length}.MoSu"),
            self::MONDAY_FRIDAY => trans("eev.core::lang.working_days.{$length}.MoFr"),
            self::MONDAY => trans("eev.core::lang.working_days.{$length}.Mo"),
            self::TUESDAY => trans("eev.core::lang.working_days.{$length}.Tu"),
            self::WEDNESDAY => trans("eev.core::lang.working_days.{$length}.We"),
            self::THURSDAY => trans("eev.core::lang.working_days.{$length}.Th"),
            self::FRIDAY => trans("eev.core::lang.working_days.{$length}.Fr"),
            self::SATURDAY_SUNDAY => trans("eev.core::lang.working_days.{$length}.SaSu"),
            self::SATURDAY => trans("eev.core::lang.working_days.{$length}.Sa"),
            self::SUNDAY => trans("eev.core::lang.working_days.{$length}.Su"),
        ];
    }

}