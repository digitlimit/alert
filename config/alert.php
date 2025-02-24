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
        'tailwind' => Themes\Tailwind::class,
        'bootstrap5' => Themes\Bootstrap5::class,
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
                'component' => Themes\Tailwind\Message::class,
            ],

            'field' => [
                'view' => 'alert-field',
                'alert' => Types\Field::class,
                'component' => Themes\Tailwind\Field::class,
            ],

            'bag' => [
                'view' => 'alert-field',
                'alert' => Types\FieldBag::class,
                'component' => Themes\Tailwind\Field::class,
            ],

            'modal' => [
                'view' => 'alert-modal',
                'alert' => Types\Modal::class,
                'component' => Themes\Tailwind\Modal::class,
            ],

            'notify' => [
                'view' => 'alert-notify',
                'alert' => Types\Notify::class,
                'component' => Themes\Tailwind\Notify::class,
            ],

            'sticky' => [
                'view' => 'alert-sticky',
                'alert' => Types\Sticky::class,
                'component' => Themes\Tailwind\Sticky::class,
            ],
        ]
    ],

    'bootstrap5' => [
        'types' => [
            'message' => [
                'view' => 'alert-message',
                'alert' => Types\Message::class,
                'component' => Themes\Bootstrap5\Message::class,
            ],

            'field' => [
                'view' => 'alert-field',
                'alert' => Types\Field::class,
                'component' => Themes\Bootstrap5\Field::class,
            ],

            'bag' => [
                'view' => 'alert-field',
                'alert' => Types\FieldBag::class,
                'component' => Themes\Bootstrap5\Field::class,
            ],

            'modal' => [
                'view' => 'alert-modal',
                'alert' => Types\Modal::class,
                'component' => Themes\Bootstrap5\Modal::class,
                'sizes' => [
                    'default' => 'modal-md',
                    'small' => 'modal-sm',
                    'medium' => 'modal-md',
                    'large' => 'modal-lg',
                    'extra-large' => 'modal-xl',
                    'fullscreen' => 'modal-fullscreen',
                ]
            ],

            'notify' => [
                'view' => 'alert-notify',
                'alert' => Types\Notify::class,
                'component' => Themes\Bootstrap5\Notify::class,
                'positions' => [
                    'default' => 'top-0 start-0',
                    'top-right' => 'top-0 end-0',
                    'top-left' => 'top-0 start-0',
                    'bottom-right' => 'bottom-0 end-0',
                    'bottom-left' => 'bottom-0 start-0',
                    'top-center' => 'top-0 start-50 translate-middle-x',
                    'bottom-center' => 'bottom-0 start-50 translate-middle-x',
                    'center' => 'top-50 start-50 translate-middle',
                ]
            ],

            'sticky' => [
                'view' => 'alert-sticky',
                'alert' => Types\Sticky::class,
                'component' => Themes\Bootstrap5\Sticky::class,
            ],
        ]
    ],
];
