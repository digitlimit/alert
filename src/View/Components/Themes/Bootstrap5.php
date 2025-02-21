<?php

namespace Digitlimit\Alert\View\Components\Themes;

use Digitlimit\Alert\Contracts\ThemeInterface;
use Illuminate\Support\Facades\Blade;
use Digitlimit\Alert\Types;

class Bootstrap5 implements ThemeInterface
{
    /**
     *  Register the alert types
     */
    public function types(): array
    {
        return [
            'message' => [
                'view' => 'alert-message',
                'alert' => Types\Message::class,
                'component' => Bootstrap5\Message::class,
            ],

            'field' => [
                'view' => 'alert-field',
                'alert' => Types\Field::class,
                'component' => Bootstrap5\Field::class,
            ],

            'bag' => [
                'view' => 'alert-field',
                'alert' => Types\FieldBag::class,
                'component' => Bootstrap5\Field::class,
            ],

            'modal' => [
                'view' => 'alert-modal',
                'alert' => Types\Modal::class,
                'component' => Bootstrap5\Modal::class,
            ],

            'notify' => [
                'view' => 'alert-notify',
                'alert' => Types\Notify::class,
                'component' => Bootstrap5\Notify::class,
            ],

            'sticky' => [
                'view' => 'alert-sticky',
                'alert' => Types\Sticky::class,
                'component' => Bootstrap5\Sticky::class,
            ],
        ];
    }

    /**
     * Register the alert components
     */
    public function boot(): void
    {
        Blade::componentNamespace(__NAMESPACE__, 'alert');

        foreach ($this->types() as $type) {
            Blade::component($type['view'], $type['component']);
        }
    }
}
