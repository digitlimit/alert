<?php

namespace Digitlimit\Alert\Themes;

use Digitlimit\Alert\Contracts\ThemeInterface;
use Digitlimit\Alert\Themes;
use Digitlimit\Alert\Types;
use Illuminate\Support\Facades\Blade;

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
