<?php

namespace Digitlimit\Alert\Themes\Tailwind;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Digitlimit\Alert\Contracts\ThemeInterface;
use Digitlimit\Alert\Foundation\AbstractTheme;
use Digitlimit\Alert\Helpers\SessionKey;
use Livewire\Component;
use Livewire\Livewire;

use function Livewire\on;
use function Livewire\store;

class Tailwind extends AbstractTheme implements ThemeInterface
{
    /**
     *  Register the alert types.
     */
    public static function types(): array
    {
        return config('alert.tailwind.types');
    }

    /**
     * Register the alert components.
     */
    public static function registerComponents(): void
    {
        $types = self::types();

        foreach ($types as $type) {
            Livewire::component($type['view'], $type['component']);
        }
    }

    /**
     * Dehydrate the alert to the component.
     */
    public static function dehydrate(): void
    {
        on('dehydrate', function (Component $component) {
            if (!Livewire::isLivewireRequest()) {
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

            $all = Alert::all();

            foreach ($all as $type => $alerts) {
                $event = 'refresh-alert-'.$type;

                foreach ($alerts as $tag => $tagAlerts) {
                    if (empty($tagAlerts)) {
                        continue;
                    }

                    $tagAlerts = collect($tagAlerts)->map(function ($alert) {
                        return $alert->toArray();
                    });

                    $component->dispatch($event, $tag, $tagAlerts);
                }
            }
        });
    }
}
