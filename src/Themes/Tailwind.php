<?php

namespace Digitlimit\Alert\Themes;

use Digitlimit\Alert\Alert;
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
    public const ALERT_MESSAGE = 'alert-message';
    public const ALERT_FIELD = 'alert-field';
    public const ALERT_FIELD_BAG = 'alert-field-bag';
    public const ALERT_MODAL = 'alert-modal';
    public const ALERT_NOTIFY = 'alert-notify';
    public const ALERT_STICKY = 'alert-sticky';

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

            if(!is_a($component, Themes\Tailwind\Modal::class)) {
                foreach(Alert::all('modal') as $tag => $modal) {
                    $component->dispatch('refresh-alert-modal', $tag, $modal->toArray());
                }
            }

            return $component;
        });
    }

    public function listeners(): void
    {
//        Event::listen(Events\Field\Flashed::class, function ($event) {
//           $this->dispatch(self::ALERT_FIELD, $event->alert->toArray());
//        });
//
//        Event::listen(Events\FieldBag\Flashed::class, function ($event) {
//            $this->dispatch(self::ALERT_FIELD_BAG, $event->alert->toArray());
//        });
//
//        Event::listen(Events\Message\Flashed::class, function ($event) {
//            $this->dispatch(self::ALERT_MESSAGE, $event->alert->toArray());
//        });
//
//        Event::listen(Events\Modal\Flashed::class, function ($event) {
//            (new Themes\Tailwind\Modal)->dispatch(self::ALERT_MODAL, $event->alert->toArray());
//        });
//
//        Event::listen(Events\Notify\Flashed::class, function ($event) {
//            $this->dispatch(self::ALERT_NOTIFY, $event->alert->toArray());
//        });
//
//        Event::listen(Events\Sticky\Flashed::class, function ($event) {
//            $this->dispatch(self::ALERT_STICKY, $event->alert->toArray());
//        });
    }
}
