<?php namespace DigitFab\Core\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Model;
use October\Rain\Database\Traits\Sortable;

/**
 * Model
 */
class WorkingPeriod extends Model
{
    use \October\Rain\Database\Traits\Validation, Sortable;

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

    public $timestamps = false;

    public $table = 'digitfab_core_working_periods';

    public $rules = [
    ];

    protected $casts = [
        'around_the_clock' => 'boolean',
    ];

    public function getDayOptions() {
        return Lang::get("digitfab.core::lang.working_days.normal");
    }

    public function getTimeFromAttribute($value) {
        return !empty($value) ? Carbon::createFromFormat('H:i:s', $value)->format('H:i') : '';
    }

    public function getTimeTillAttribute($value) {
        return !empty($value) ? Carbon::createFromFormat('H:i:s', $value)->format('H:i') : '';
    }

    public function getDayNameAttribute() {
        return Lang::get("digitfab.core::lang.working_days.normal.{$this->day}");
    }

    public function getNameAttribute() {
        return $this->id . ' - '. $this->day_name;
    }
}
