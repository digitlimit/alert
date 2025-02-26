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
        ],
        'buttons' => [
            'primary' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900',
            'secondary' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2',

            'success' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2 bg-green-600 hover:bg-green-700',
            'error' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2 bg-red-600 hover:bg-red-700',
            'warning' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-black transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600 focus:ring-offset-2 bg-yellow-400 hover:bg-yellow-500',
            'info' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-offset-2 bg-blue-600 hover:bg-blue-700',
            'light' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-black transition-colors border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 bg-white hover:bg-gray-100',
            'dark' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 bg-gray-800 hover:bg-gray-900',
            'link' => 'inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-blue-600 transition-colors rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:underline',
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
        'classes' => [
           'field' => [
               'levels' => [
                   'success' => 'p-3 border-l-4 rounded-md bg-green-100 border-green-500 text-green-800',
                   'error' => 'p-3 border-l-4 rounded-md bg-red-100 border-red-500 text-red-800',
                   'warning' => 'p-3 border-l-4 rounded-md bg-yellow-100 border-yellow-500 text-yellow-800',
                   'info' => 'p-3 border-l-4 rounded-md bg-blue-100 border-blue-500 text-blue-800',
               ],
           ]
        ],

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
