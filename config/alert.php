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
        'alert-normal' => [
            'alert'     => \Digitlimit\Alert\Types\Normal::class,
            'component' => \Digitlimit\Alert\View\Components\Normal::class,
        ],

        'alert-field' => [
            'alert'     => \Digitlimit\Alert\Types\Field::class,
            'component' => \Digitlimit\Alert\View\Components\Field::class
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
    ],

    // @todo
    // 'themes' => [
    //     'theme'       => 'bootstrap-5',
    //     'bootstrap-5' => [
    //         'levels' => [
    //             'info' => '...'
    //         ]
    //     ]
    // ]
];
