<?php

namespace Defaultlaravelsettings\Settings\App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $root = '/../..';

        $path_to_views = $root . '/resources/views/settings';

        $this->loadRoutesFrom(__DIR__ . $root . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . $path_to_views, 'settings');
        $this->loadMigrationsFrom(__DIR__ . $root . '/database/migrations');

        $this->publishes([
            __DIR__ . $path_to_views => resource_path('views/vendor/settings'),
            __DIR__ . $root . '/config/settings.php' => config_path('settings.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
