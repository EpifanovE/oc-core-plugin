<?php namespace EEV\Core\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class SocialController extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController',
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'eev.core.socials'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('EEV.Core', 'company', 'socials');
    }
}
