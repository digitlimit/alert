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
        'tailwind' => [
            'components' => 'Digitlimit\Alert\View\Components\Themes\Tailwind',
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
            ],
        ],
        'bootstrap5' => [
            'components' => 'Digitlimit\Alert\View\Components\Themes\Bootstrap5',
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
                ],

                'notify' => [
                    'view' => 'alert-notify',
                    'alert' => Types\Notify::class,
                    'component' => Themes\Bootstrap5\Notify::class,
                ],

                'sticky' => [
                    'view' => 'alert-sticky',
                    'alert' => Types\Sticky::class,
                    'component' => Themes\Bootstrap5\Sticky::class,
                ],
            ],
        ],
    ],
];
