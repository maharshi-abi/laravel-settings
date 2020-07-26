<?php

namespace MAHARSHIABI\Settings\App;

class SettingsHelper
{
    /**
     * SettingsHelper constructor.
     */
    function __construct()
    {
    }

    public function get($key = '', $default = null)
    {
        if (strpos($key, '*')) {
            $key = str_replace('*', '%', $key);
            $settings = Setting::where('code', 'like', $key);

            $result = [];

            foreach ($settings->get() as $item) {
                $result[$item->code] = $item->value;
            }

            if (empty($result) && !is_null($default)) {
                return $default;
            }

            return $result;
        }

        $setting = Setting::whereCode($key);

        $setting = $setting->first();

        if ($setting) {
            return $setting->value;
        } elseif (!is_null($default)) {
            return $default;
        } else {
            return '';
        }
    }

    public function has($key)
    {
        if (strpos($key, '*')) {
            $key = str_replace('*', '%', $key);
            return (Setting::where('code', 'like', $key)->count() > 0);
        }

        return (Setting::whereCode($key)->count() > 0);
    }
}