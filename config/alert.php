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

    'theme' => 'bootstrap5',

    /*
    |--------------------------------------------------------------------------
    | Themes
    |--------------------------------------------------------------------------
    |
    | Here you may register your custom alert themes
    |
    */
    'themes' => [
        'classic' => [
            'components' => 'Digitlimit\Alert\View\Components\Themes\Classic',
            'types' => [
                'message' => [
                    'view' => 'alert-message',
                    'alert' => Types\Message::class,
                    'component' => Themes\Classic\Message::class,
                ],

                'field' => [
                    'view' => 'alert-field',
                    'alert' => Types\Field::class,
                    'component' => Themes\Classic\Field::class,
                ],

                'bag' => [
                    'view' => 'alert-field',
                    'alert' => Types\FieldBag::class,
                    'component' => Themes\Classic\Field::class,
                ],

                'modal' => [
                    'view' => 'alert-modal',
                    'alert' => Types\Modal::class,
                    'component' => Themes\Classic\Modal::class,
                ],

                'notify' => [
                    'view' => 'alert-notify',
                    'alert' => Types\Notify::class,
                    'component' => Themes\Classic\Notify::class,
                ],

                'sticky' => [
                    'view' => 'alert-sticky',
                    'alert' => Types\Sticky::class,
                    'component' => Themes\Classic\Sticky::class,
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
