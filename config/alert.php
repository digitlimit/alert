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
        'normal' => [
            'view'      => 'alert-normal',
            'alert'     => \Digitlimit\Alert\Types\Normal::class,
            'component' => \Digitlimit\Alert\View\Components\Normal::class,
        ],

        'field' => [
            'view'      => 'alert-field',
            'alert'     => \Digitlimit\Alert\Types\Field::class,
            'component' => \Digitlimit\Alert\View\Components\Field::class,
        ],

        'bag' => [
            'view'      => 'alert-field',
            'alert'     => \Digitlimit\Alert\Types\FieldBag::class,
            'component' => \Digitlimit\Alert\View\Components\Field::class,
        ],

        'modal' => [
            'view'      => 'alert-modal',
            'alert'     => \Digitlimit\Alert\Types\Modal::class,
            'component' => \Digitlimit\Alert\View\Components\Modal::class,
        ],

        'notify' => [
            'view'      => 'alert-notify',
            'alert'     => \Digitlimit\Alert\Types\Notify::class,
            'component' => \Digitlimit\Alert\View\Components\Notify::class,
        ],

        'sticky' => [
            'view'      => 'alert-sticky',
            'alert'     => \Digitlimit\Alert\Types\Sticky::class,
            'component' => \Digitlimit\Alert\View\Components\Sticky::class,
        ],
    ],
];
