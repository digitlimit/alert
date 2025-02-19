<?php

use Digitlimit\Alert\Types;
use Digitlimit\Alert\View\Components\Themes;

return [

    /*
     |--------------------------------------------------------------------------
     | Default Theme
     |--------------------------------------------------------------------------
     |
     | Here you may set the default theme for your alerts
     |
     */

    'theme' => 'tailwind',

    /*
    |--------------------------------------------------------------------------
    | Themes
    |--------------------------------------------------------------------------
    |
    | Here you may register your custom alert themes
    |
    */
    'themes' => [
        'tailwind' => Digitlimit\Alert\View\Components\Themes\Tailwind::class,
        'bootstrap5' => Digitlimit\Alert\View\Components\Themes\Bootstrap5::class,
    ],
];
