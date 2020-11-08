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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function afterFetch()
    {
        if ( ! empty($this->type)) {
            $this->typeObject = WidgetType::getTypeObject($this->type, $this->data, $this->template);
        }
    }

    public function afterUpdate()
    {
        $areasManager = new AreasManager();
        $area = $areasManager->getArea($this->area);
        Cache::forget($area->getCacheKey());
    }

    public function getTypeObject()
    {
        return $this->typeObject;
    }

    public function getHtml(Area $area)
    {
        $params = [
            'data'    => $this->data,
            'classes' => $this->classes,
            'id'      => $this->id,
            'type'    => $this->type,
        ];

        return $this->typeObject->getHtml($params)->render();
    }

    public function getStyles($componentProperties)
    {
        return $this->typeObject->getStyles($componentProperties);
    }
}
