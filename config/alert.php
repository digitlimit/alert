<?php

use Digitlimit\Alert\Themes;
use Digitlimit\Alert\Types;

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
        'tailwind' => Themes\Tailwind\Tailwind::class,
    ],

    'icons' => [
        'success' => \Digitlimit\Alert\Component\Icons\Success::class,
        'error' => \Digitlimit\Alert\Component\Icons\Error::class,
        'warning' => \Digitlimit\Alert\Component\Icons\Warning::class,
        'info' => \Digitlimit\Alert\Component\Icons\Info::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Themes Settings
    |--------------------------------------------------------------------------
    |
    | Themes settings
    |
    */
    'tailwind' => [
        'types' => [
            'message' => [
                'view' => 'alert-message',
                'alert' => Types\Message::class,
                'component' => Themes\Tailwind\Components\Message::class,
            ],

            'field' => [
                'view' => 'alert-field',
                'alert' => Types\Field::class,
                'component' => Themes\Tailwind\Components\Field::class,
            ],

            'modal' => [
                'view' => 'alert-modal',
                'alert' => Types\Modal::class,
                'component' => Themes\Tailwind\Components\Modal::class,
            ],

            'toastr' => [
                'view' => 'alert-toastr',
                'alert' => Types\Toastr::class,
                'component' => Themes\Tailwind\Components\Toastr::class,
            ],

            'notify' => [
                'view' => 'alert-notify',
                'alert' => Types\Notify::class,
                'component' => Themes\Tailwind\Components\Notify::class,
            ],
        ],

        'attributes' => [
            'buttons' => [
                'action' => [
                    'type' => 'button',
                    '@click' => 'show = false;',
                ],
                'cancel' => [
                    'type' => 'button',
                    '@click' => 'show = false;',
                ],
            ],
            'links' => [
                'action' => [
                    'type' => 'button',
                    '@click' => 'show = false;',
                ],
                'cancel' => [
                    'type' => 'button',
                    '@click' => 'show = false;',
                ],
            ],
        ],
    ],
];
