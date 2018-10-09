<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin url
    |--------------------------------------------------------------------------
    |
    | Root part of admin url.
    |
    */

    'admin_url' => 'bradmin',

    /*
    |--------------------------------------------------------------------------
    | Admin user path
    |--------------------------------------------------------------------------
    |
    | Path to user-side directory of admin published files.
    |
    */

    'user_path' => 'App\Admin',

    'base_models_path' => 'App\\',

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Displayed in title and header.
    |
    */

    'title' => 'Bradmin',

    /*
    |--------------------------------------------------------------------------
    | Admin Logo
    |--------------------------------------------------------------------------
    |
    | Displayed in navigation panel.
    |
    */




//    'logo'      => '/images/user-logo.jpg',
    'logo'      => '/bradmin/images/logo.jpg',

//    'logo_mini' => '',


    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    */

    'middleware' => ['web'],

];
