<?php

namespace Digitlimit\Alert\View\Components\Themes;

use Digitlimit\Alert\Contracts\ThemeInterface;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Types;
use Livewire\Component;
use Livewire\Livewire;
use function Livewire\on;
use function Livewire\store;

class Tailwind implements ThemeInterface
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
                'component' => Tailwind\Message::class,
            ],

            'field' => [
                'view' => 'alert-field',
                'alert' => Types\Field::class,
                'component' => Tailwind\Field::class,
            ],

            'bag' => [
                'view' => 'alert-field',
                'alert' => Types\FieldBag::class,
                'component' => Tailwind\Field::class,
            ],

            'modal' => [
                'view' => 'alert-modal',
                'alert' => Types\Modal::class,
                'component' => Tailwind\Modal::class,
            ],

            'notify' => [
                'view' => 'alert-notify',
                'alert' => Types\Notify::class,
                'component' => Tailwind\Notify::class,
            ],

            'sticky' => [
                'view' => 'alert-sticky',
                'alert' => Types\Sticky::class,
                'component' => Tailwind\Sticky::class,
            ],
        ];
    }

    /**
     * Register the alert components
     */
    public function boot(): void
    {
        foreach ($this->types() as $type) {
            Livewire::component($type['view'], $type['component']);
        }

        on('dehydrate', function (Component $component)
        {
            if (! $this->shouldHydrate($component)) {
                return;
            }

            dd(store($component));

            $component->dispatch('refresh');
        });
    }

    public function shouldHydrate(Component $component)
    {
        if (! Livewire::isLivewireRequest()) {
            return false;
        }

        if (store($component)->has('redirect')) {
            return false;
        }

        if (count(session()->get(SessionKey::mainKey()) ?? []) <= 0) {
            return false;
        }

        return true;
    }
}
