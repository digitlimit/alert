<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Types
    |--------------------------------------------------------------------------
    |
    | Here you may register your custom alert types
    |
    */

    'types' => [
        'message' => [
            'view'      => 'alert-message',
            'alert'     => \Digitlimit\Alert\Types\Message::class,
            'component' => \Digitlimit\Alert\View\Components\Themes\Bootstrap5\Message::class,
        ],

        'field' => [
            'view'      => 'alert-field',
            'alert'     => \Digitlimit\Alert\Types\Field::class,
            'component' => \Digitlimit\Alert\View\Components\Themes\Bootstrap5\Field::class,
        ],

        'bag' => [
            'view'      => 'alert-field',
            'alert'     => \Digitlimit\Alert\Types\FieldBag::class,
            'component' => \Digitlimit\Alert\View\Components\Themes\Bootstrap5\Field::class,
        ],

        'modal' => [
            'view'      => 'alert-modal',
            'alert'     => \Digitlimit\Alert\Types\Modal::class,
            'component' => \Digitlimit\Alert\View\Components\Themes\Bootstrap5\Modal::class,
        ],

        'notify' => [
            'view'      => 'alert-notify',
            'alert'     => \Digitlimit\Alert\Types\Notify::class,
            'component' => \Digitlimit\Alert\View\Components\Themes\Bootstrap5\Notify::class,
        ],

        'sticky' => [
            'view'      => 'alert-sticky',
            'alert'     => \Digitlimit\Alert\Types\Sticky::class,
            'component' => \Digitlimit\Alert\View\Components\Themes\Bootstrap5\Sticky::class,
        ],
    ],

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
        'bootstrap5' => [
            'views'      => 'components/themes/bootstrap5',
            'components' => 'Digitlimit\Alert\View\Components\Themes\Bootstrap5',
        ],
    ],
];
