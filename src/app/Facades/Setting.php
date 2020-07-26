<?php

namespace MAHARSHIABI\Settings\App\Facades;

use Illuminate\Support\Facades\Facade;
use MAHARSHIABI\Settings\App\SettingsHelper;

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