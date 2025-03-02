<?php

namespace Digitlimit\Alert\Themes\Tailwind;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Contracts\ThemeInterface;
use Digitlimit\Alert\Foundation\AbstractTheme;
use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Helpers\SessionKey;
use Livewire\Component;
use Livewire\Livewire;

use function Livewire\on;
use function Livewire\store;

class Tailwind extends AbstractTheme implements ThemeInterface
{
    /**
     *  Register the alert types
     */
    public static function types(): array
    {
        return config('alert.tailwind.types');
    }

    /**
     * Register the alert components
     */
    public static function registerComponents(): void
    {
        $types = self::types();

        foreach ($types as $type) {
            Livewire::component($type['view'], $type['component']);
        }
    }

    /**
     * Dehydrate the alert to the component
     */
    public static function dehydrate(): void
    {
        on('dehydrate', function (Component $component) {
            if (! Livewire::isLivewireRequest()) {
                return false;
            }

            if (store($component)->has('redirect')) {
                return false;
            }

            if (count(session()->get(SessionKey::mainKey()) ?? []) <= 0) {
                return false;
            }

            if (is_a($component, LivewireInterface::class)) {
                return false;
            }

            foreach (Alert::all() as $alerts) {

                if (empty($alerts)) {
                    continue;
                }

                foreach ($alerts as $tag => $alert) {

                    // For single alert example message, modal
                    if (! is_array($alert)) {
                        self::dispatch($component, $alert);

                        continue;
                    }
                    // For multiple alerts, usually from a field
                    foreach ($alert as $field) {
                        self::dispatch($component, $field);
                    }
                }
            }

            return $component;
        });
    }

    /**
     * Dispatch the alert to the component
     */
    protected static function dispatch(Component $component, AlertInterface|Taggable $alert): Component
    {
        $event = 'refresh-alert-'.$alert->key();

        $component->dispatch(
            $event,
            $alert->getTag(),
            $alert->toArray()
        );

        return $component;
    }
}
