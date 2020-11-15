<?php namespace DigitFab\Core\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'digitfab_core_settings';

    public $settingsFields = 'fields.yaml';
}
