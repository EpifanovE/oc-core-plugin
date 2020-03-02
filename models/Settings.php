<?php namespace EEV\Core\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'eev_core_settings';

    public $settingsFields = 'fields.yaml';
}
