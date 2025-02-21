<?php

namespace Digitlimit\Alert\Themes;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Themes;
use Digitlimit\Alert\Events;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Types;
use Illuminate\Support\Facades\Event;
use Livewire\Component;
use Livewire\Livewire;
use Digitlimit\Alert\Contracts\ThemeInterface;
use Digitlimit\Alert\Contracts\LivewireInterface;

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

        $this->dehydrate();

        $this->listeners();
    }

    public function registerComponents(): void
    {
        $types = $this->types();

        Livewire::component($types['message']['view'], Themes\Tailwind\Message::class);
        Livewire::component($types['field']['view'], Themes\Tailwind\Field::class);
        Livewire::component($types['modal']['view'], Themes\Tailwind\Modal::class);
        Livewire::component($types['notify']['view'], Themes\Tailwind\Notify::class);
        Livewire::component($types['sticky']['view'], Themes\Tailwind\Sticky::class);
    }

    public function dehydrate(): void
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

            if(! is_a($component, LivewireInterface::class)) {
                foreach (Alert::all() as $alerts) {
                    foreach ($alerts as $tag => $alert) {
                        $component->dispatch(
                            'refresh-alert-' . $alert->key(),
                            $alert->getTag(),
                            $alert->toArray()
                        );
                    }
                }
            }

            return $component;
        });
    }

    public function listeners(): void
    {
//        Event::listen(Events\Modal\Flashed::class, function ($event) {
//            (new Themes\Tailwind\Modal)
//                ->refresh(
//                    $event->alert->getTag(),
//                    $event->alert->toArray()
//                );
//        });
    }
}
