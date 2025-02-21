<?php

namespace Digitlimit\Alert\Themes;

use Digitlimit\Alert\Themes;
use Digitlimit\Alert\Contracts\ThemeInterface;
use Digitlimit\Alert\Events;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Types;
use Illuminate\Support\Facades\Event;
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
        ];
    }

    /**
     * Register the alert components
     */
    public function boot(): void
    {
        $this->registerComponents();

        $this->listeners();

        $this->hydrate();
    }

    public function registerComponents(): void
    {
        foreach ($this->types() as $type) {
            Livewire::component($type['view'], $type['component']);
        }
    }

    public function listeners(): void
    {
        Event::listen(Events\Field\Flashed::class, function ($event) {
            info('Field Flashed', [
                'message' => $event->alert->message,
                'id' => $event->alert->getId(),
            ]);
        });

        Event::listen(Events\FieldBag\Flashed::class, function ($event) {
            info('Field Bag Flashed', [
                'message' => $event->alert->message,
                'id' => $event->alert->getId(),
            ]);
        });

        Event::listen(Events\Message\Flashed::class, function ($event) {
            info('Message Flashed', [
                'message' => $event->alert->message,
                'id' => $event->alert->getId(),
            ]);
        });

        Event::listen(Events\Modal\Flashed::class, function ($event) {
            info('Modal Flashed', [
                'message' => $event->alert->message,
                'id' => $event->alert->getId(),
            ]);
        });

        Event::listen(Events\Notify\Flashed::class, function ($event) {
            info('Notify Flashed', [
                'message' => $event->alert->message,
                'id' => $event->alert->getId(),
            ]);
        });

        Event::listen(Events\Sticky\Flashed::class, function ($event) {
            info('Sticky Flashed', [
                'message' => $event->alert->message,
                'id' => $event->alert->getId(),
            ]);
        });
    }

    public function hydrate(): void
    {
        on('dehydrate', function (Component $component)
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

            dd(store($component));

            $component->dispatch('refresh');
        });
    }
}
