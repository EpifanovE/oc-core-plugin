<?php


namespace EEV\Core\Classes\Company;


class WorkingPeriodData
{

    public static function getDays($length = 'normal') {
        return [
            "Mo-Su" => trans("eev.core::lang.working_days.{$length}.MoSu"),
            "Mo-Fr" => trans("eev.core::lang.working_days.{$length}.MoFr"),
            "Mo" => trans("eev.core::lang.working_days.{$length}.Mo"),
            "Tu" => trans("eev.core::lang.working_days.{$length}.Tu"),
            "We" => trans("eev.core::lang.working_days.{$length}.We"),
            "Th" => trans("eev.core::lang.working_days.{$length}.Th"),
            "Fr" => trans("eev.core::lang.working_days.{$length}.Fr"),
            "Sa-Su" => trans("eev.core::lang.working_days.{$length}.SaSu"),
            "Sa" => trans("eev.core::lang.working_days.{$length}.Sa"),
            "Su" => trans("eev.core::lang.working_days.{$length}.Su"),
        ];
    }

}