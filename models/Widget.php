<?php

namespace DigitFab\Core\Models;

use DigitFab\Core\Classes\Widgets\Types\WidgetType;
use Model;
use October\Rain\Database\Traits\Sortable;
use October\Rain\Database\Traits\Validation;

class Widget extends Model
{
    use Validation;

    public $table = 'digitfab_core_widgets';

    public $rules = [
    ];

    protected $fillable = [
        'data',
        'name',
        'type',
        'template',
    ];

    protected $jsonable = ['data',];

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

    public function getTypeLabelAttribute() {
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

    public function getTypeObject() {
        return $this->typeObject;
    }

    public function getHtml($componentProperties)
    {
        return $this->typeObject->getHtml($componentProperties);
    }

    public function getStyles($componentProperties) {
        return $this->typeObject->getStyles($componentProperties);
    }
}