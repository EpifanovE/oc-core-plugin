<?php namespace EEV\Core\Models;

use Carbon\Carbon;
use EEV\Core\Classes\Company\WorkingPeriodData;
use Model;
use October\Rain\Database\Traits\Sortable;

/**
 * Model
 */
class WorkingPeriod extends Model
{
    use \October\Rain\Database\Traits\Validation, Sortable;

    public $timestamps = false;

    public $table = 'eev_core_working_periods';

    public $rules = [
    ];

    protected $casts = [
        'around_the_clock' => 'boolean',
    ];

    public function getDayOptions() {
        return WorkingPeriodData::getDays();
    }

    public function getTimeFromAttribute($value) {
        return !empty($value) ? Carbon::createFromFormat('H:i:s', $value)->format('H:i') : '';
    }

    public function getTimeTillAttribute($value) {
        return !empty($value) ? Carbon::createFromFormat('H:i:s', $value)->format('H:i') : '';
    }

    public function getDayNameAttribute() {
        $days = WorkingPeriodData::getDays();
        return $days[$this->day];
    }

    public function getNameAttribute() {
        return $this->id . ' - '. $this->day_name;
    }
}
