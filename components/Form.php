<?php namespace DigitFab\Core\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Exception;
use October\Rain\Exception\ValidationException;
use October\Rain\Support\Facades\Flash;

class Form extends ComponentBase
{
    protected $form;

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);

        $this->form = \DigitFab\Core\Classes\Forms\Form::get($this->property('form'));
    }

    public function componentDetails()
    {
        return [
            'name' => 'digitfab.core::lang.components.form.name',
            'description' => 'digitfab.core::lang.components.form.desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'form' => [
                'title' => 'digitfab.core::lang.form',
                'description' => '',
                'default' => 'none',
                'type' => 'dropdown',
                'showExternalParam' => false,
                'group' => 'digitfab.core::lang.params',
            ],
            'adv_class' => [
                'title' => 'digitfab.core::lang.adv_class',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
                'group' => 'digitfab.core::lang.params',
            ],
        ];
    }

    public function getFormOptions()
    {
        return \DigitFab\Core\Classes\Forms\Form::getFormsList();
    }

    public function getFields()
    {
        return $this->form->getFields();
    }

    public function getClasses()
    {
        $classes = [];

        if (!empty($this->property('adv_class'))) {
            $classes[] = $this->property('adv_class');
        }

        return ' ' . join(' ', $classes);
    }

    public function getSubmitText()
    {
        if ($text = $this->form->getSubmitText()) {
            return $text;
        }

        return Lang::get('digitfab.core::lang.submit');
    }

    public function onRun()
    {
        if ($this->form->hasFieldType('recaptcha')) {
            $this->addJs('https://www.google.com/recaptcha/api.js');
        }
    }

    public function onSubmit()
    {
        $data = Input::all();

        $validator = Validator::make(
            $data,
            $this->form->getRules(),
            Lang::get('digitfab.core::validation')
        );

        if ($attrs = $this->form->getAttributeNames()) {
            $validator->setAttributeNames($attrs);
        }

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            $this->form->handle($data);

            if ($message = $this->form->getSuccessMessage()) {
                Flash::success($message);
            }

        } catch (Exception $e) {
            if ($message = $this->form->getErrorMessage()) {
                Flash::error($message);
            }
        }
    }

    public function checkForm()
    {
        return !empty($this->property('form')) && !empty($this->form);
    }

    public function isShowTitle() {
        return $this->form->isShowTitle();
    }

    public function getTitle() {
        return $this->form->getDisplayName();
    }

    public function getTextBefore() {
        return $this->form->getTextBefore();
    }

    public function getTextAfter() {
        return $this->form->getTextAfter();
    }

    public function getTextBeforeSubmit() {
        return $this->form->getTextBeforeSubmit();
    }
}
