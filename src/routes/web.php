<?php

Route::group(['middleware' => config('settings.middleware')], function () {
    Route::resource(config('settings.route'), 'MAHARSHIABI\Settings\App\Http\Controllers\SettingsController');
    Route::get(config('settings.route') . '/download/{setting}', 'MAHARSHIABI\Settings\App\Http\Controllers\SettingsController@fileDownload');
});
