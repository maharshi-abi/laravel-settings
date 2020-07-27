<?php

namespace Defaultlaravelsettings\Settings\App\Facades;

use Illuminate\Support\Facades\Facade;
use Defaultlaravelsettings\Settings\App\SettingsHelper;

class Setting extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return SettingsHelper::class;
    }
}