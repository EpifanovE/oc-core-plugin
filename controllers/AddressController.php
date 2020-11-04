<?php namespace DigitFab\Core\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class AddressController extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'digitfab.core.addresses'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('DigitFab.Core', 'company', 'addresses');
    }
}
