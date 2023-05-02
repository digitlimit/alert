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
        'alert-bar' => [
            'alert'     => \Digitlimit\Alert\Types\Bar::class,
            'component' => \Digitlimit\Alert\View\Components\Bar::class
        ],

        'alert-field' => [
            'alert'     => \Digitlimit\Alert\Types\Field::class,
            'component' => \Digitlimit\Alert\View\Components\Field::class
        ],

        'alert-form' => [
            'alert'     => \Digitlimit\Alert\Types\Form::class,
            'component' => \Digitlimit\Alert\View\Components\Form::class
        ],

        'alert-modal' => [
            'alert'     => \Digitlimit\Alert\Types\Modal::class,
            'component' => \Digitlimit\Alert\View\Components\Modal::class
        ],

        'alert-notify' => [
            'alert'     => \Digitlimit\Alert\Types\Notify::class,
            'component' => \Digitlimit\Alert\View\Components\Notify::class
        ],

        'alert-sticky' => [
            'alert'     => \Digitlimit\Alert\Types\Sticky::class,
            'component' => \Digitlimit\Alert\View\Components\Sticky::class
        ]
    ]
];
