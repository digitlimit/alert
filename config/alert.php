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
        'classes' => [
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

            'field' => [
                'levels' => [
                    'success' => [
                        'container' => 'p-3 text-green-800',
                    ],
                    'error' => [
                        'container' => 'p-3 text-red-800',
                    ],
                    'warning' => [
                        'container' => 'p-3 text-yellow-800',
                    ],
                    'info' => [
                        'container' => 'p-3 text-blue-800',
                    ],
                ],
            ],

            'notify' => [
                'levels' => [
                    'success' => [
                        'container' => 'bg-gray-900 bg-gradient-to-r text-white rounded-t mb-3 shadow-lg flex items-center from-green-400 to-green-500',
                    ],
                    'error' => [
                        'container' => 'bg-gray-900 bg-gradient-to-r text-white rounded-t mb-3 shadow-lg flex items-center from-red-400 to-pink-500',
                    ],
                    'warning' => [
                        'container' => 'bg-gray-900 bg-gradient-to-r text-white rounded-t mb-3 shadow-lg flex items-center from-yellow-400 to-yellow-500',
                    ],
                    'info' => [
                        'container' => 'bg-gray-900 bg-gradient-to-r text-white rounded-t mb-3 shadow-lg flex items-center from-blue-400 to-blue-500',
                    ],
                ],

                'position' => [
                    'top-right' => 'top-0 right-0',
                    'top-left' => 'top-0 left-0',
                    'bottom-right' => 'bottom-0 right-0',
                    'bottom-left' => 'bottom-0 left-0',
                    'top-center' => 'top-0 left-1/2 transform -translate-x-1/2',
                    'bottom-center' => 'bottom-0 left-1/2 transform -translate-x-1/2',
                    'center' => 'top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2',
                ],
            ],

            'message' => [
                'levels' => [
                    'success' => [
                        'container' => 'flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400',
                        'close' => 'ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700',
                    ],
                    'error' => [
                        'container' => 'flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400',
                        'close' => 'ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700',
                    ],
                    'warning' => [
                        'container' => 'flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300',
                        'close' => 'ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-yellow-400 dark:hover:bg-gray-700',
                    ],
                    'info' => [
                        'container' => 'flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400',
                        'close' => 'ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700',
                    ],
                ],
            ],
        ],
    ],
];
