<?php

Route::group(['middleware' => config('settings.middleware')], function () {
    Route::resource(config('settings.route'), 'Defaultlaravelsettings\Settings\App\Http\Controllers\SettingsController');
    Route::get(config('settings.route') . '/download/{setting}', 'Defaultlaravelsettings\Settings\App\Http\Controllers\SettingsController@fileDownload');
});
