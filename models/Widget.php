<?php

namespace DigitFab\Core\Models;

use DigitFab\Core\Classes\Widgets\Area;
use DigitFab\Core\Classes\Widgets\AreasManager;
use DigitFab\Core\Classes\Widgets\Types\WidgetType;
use Illuminate\Support\Facades\Cache;
use Model;
use October\Rain\Database\Traits\Validation;

class Widget extends Model
{
    use Validation;

    public $table = 'digitfab_core_widgets';

    public $rules = [
        'name' => ['required',],
        'type' => ['required',],
        'area' => ['area', 'required',],
    ];

    protected $fillable = [
        'data',
        'name',
        'type',
        'classes',
        'order',
        'area',
        'template',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $jsonable = ['data',];

    public $customMessages = [
        'area.area' => 'digitfab.core::validation.invalid_widget_area',
    ];

    protected $widget;

    /**
     * @var WidgetType
     */
    protected $typeObject;

    public function getTypeOptions()
    {
        return WidgetType::getOptions();
    }

    public function getTemplateOptions()
    {
        if ( ! empty($this->type)) {
            return $this->typeObject->getTemplatesOptions();
        }
    }

    public function getAreaOptions()
    {
        $areasManager = new AreasManager();

        return $areasManager->getAreasList();
    }

    public function getTypeLabelAttribute()
    {
        return WidgetType::getTypeLabel($this->type);
    }

    public function getAreaLabelAttribute()
    {
        $areasManager = new AreasManager();
        return $areasManager->getAreaLabel($this->area);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeArea($query, $value)
    {
        return $query->where('area', $value);
    }

    public function afterFetch()
    {
        $this->setTypeObject();
    }

    public function afterUpdate()
    {
        $areasManager = new AreasManager();
        $area = $areasManager->getArea($this->area);
        Cache::forget($area->getCacheKey());
    }

    protected function setTypeObject() {
        if ( ! empty($this->type)) {
            $this->typeObject = WidgetType::getTypeObject($this->type, $this->data, $this->id, $this->classes, $this->template);
        }
    }

    public function getTypeObject()
    {
        return $this->typeObject;
    }

    public function getHtml()
    {
        return $this->typeObject->getHtml()->render();
    }
}
