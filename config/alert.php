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
            'view' => 'alert-message',
            'alert' => \Digitlimit\Alert\Types\Message::class,
            'component' => \Digitlimit\Alert\View\Components\Message::class,
        ],

        'field' => [
            'view' => 'alert-field',
            'alert' => \Digitlimit\Alert\Types\Field::class,
            'component' => \Digitlimit\Alert\View\Components\Field::class,
        ],

        'bag' => [
            'view' => 'alert-field',
            'alert' => \Digitlimit\Alert\Types\FieldBag::class,
            'component' => \Digitlimit\Alert\View\Components\Field::class,
        ],

        'modal' => [
            'view' => 'alert-modal',
            'alert' => \Digitlimit\Alert\Types\Modal::class,
            'component' => \Digitlimit\Alert\View\Components\Modal::class,
        ],

        'notify' => [
            'view' => 'alert-notify',
            'alert' => \Digitlimit\Alert\Types\Notify::class,
            'component' => \Digitlimit\Alert\View\Components\Notify::class,
        ],

        'sticky' => [
            'view' => 'alert-sticky',
            'alert' => \Digitlimit\Alert\Types\Sticky::class,
            'component' => \Digitlimit\Alert\View\Components\Sticky::class,
        ],
    ],
];
