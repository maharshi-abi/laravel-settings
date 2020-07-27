# Laravel Settings

[![Latest Version on Packagist](https://img.shields.io/packagist/v/maharshiabi/laravel-settings.svg?style=flat-square)](https://packagist.org/packages/maharshiabi/laravel-settings)
[![Total Downloads](https://img.shields.io/packagist/dt/maharshiabi/laravel-settings.svg?style=flat-square)](https://packagist.org/packages/maharshiabi/laravel-settings)

A Laravel package that provides laravel applications settings module which needed in every application.

Supports laravel >= 5.2

## Installation

1) composer

Add the following to your composer file.

`
"maharshiabi/laravel-settings": "dev-master"
`

or run the following command:
```
composer require maharshiabi/laravel-settings --dev
```

2) config/app.php [no need for this step in laravel 5.5 because of packages auto discovery feature]

add your new provider to the providers array:

```
'providers' => [
    // ...
   	\Defaultlaravelsettings\Settings\App\Providers\SettingServiceProvider::class
    // ...
  ],
```
  
  and add Setting class to the aliases array:
  
```
'aliases' => [
	// ...
	'Settings' => \Defaultlaravelsettings\Settings\App\Facades\Setting::class
    // ...
],
```

3) publish

run the following command:
```
php artisan vendor:publish
```
`config/settings.php` and `resources/vendor/settings` will be added to your laravel project.

4) migration

you can set table name in `config/settings.php`
```
return [
	// ...
	// settings package table name the default is `settings`
    'table' => 'settings'
    // ...
];
```

the default table name is `settings`. then run the migration command

```
php artisan migrate
```
settings table will be migrated to your Database.

## Package Options

after publishing the package new config file added `config/settings.php` update values as your business requirement:
```
return [
    //settings route
    'route' => 'settings',

    'middleware' => ['web', 'auth'],

    // hidden records not editable from interface when set to false
    'show_hidden_records' => false,

    //javascript format
    'date_format' => 'mm/dd/yyyy',
    // number of digits after the decimal point
    'number_step' => 0.001,

    // upload path for settings of type file
    'upload_path' => 'uploads/settings',

    // valid mime types for settings of type file
    'mimes' => 'jpg,jpeg,png,txt,csv,pdf',

    'per_page' => 10,

    // settings package table name the default is `settings`
    'table' => 'settings'
];
```

## How to use

the default route for settings is

your-domain/settings

it will shows a list of all settings you have and you can manage your settings from there.

in the code to get a setting value use the facade like that

Validate if the key exist:

```php
\Settings::has('SETTING_KEY');
```

```php
\Settings::get('SETTING_KEY');
\Settings::get('SETTING_KEY', 'Default value if not exist');
```
for example:
```php
\Settings::get('SITE_TITLE', 'Laravel Settings');
```

also you can use astrisk to get group of settings.
for example:
```php
\Settings::get('MAIL_*');
```
will return an array of all settings with keys started with MAIL such as:
```
[
'MAIL_DRIVER' => 'smtp',
'MAIL_HOST'   => 'mailtrap.io',
'MAIL_PORT'   => '2525',
]
```
in case of file type a full path will return:
```
config('settings.upload_path') . '/' . $value;
```
such as: 

uploads/settings/site_logo.png

===================================
