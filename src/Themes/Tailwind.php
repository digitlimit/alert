<?php

namespace Digitlimit\Alert\Themes;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Digitlimit\Alert\Contracts\ThemeInterface;
use Digitlimit\Alert\Events;
use Digitlimit\Alert\Helpers\SessionKey;
use Livewire\Component;
use Livewire\Livewire;

use function Livewire\on;
use function Livewire\store;

class Tailwind extends AbstractTheme implements ThemeInterface
{
    /**
     * Register the alert components
     */
    public function boot(): void
    {
        $this->registerComponents();

        $this->dehydrate();

        $this->listeners();
    }

    /**
     *  Register the alert types
     */
    public function types(): array
    {
        return config('alert.tailwind.types');
    }

    public function registerComponents(): void
    {
        $types = $this->types();

        foreach($types as $type) {
            Livewire::component($type['view'], $type['component']);
        }
    }

    public function dehydrate(): void
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

            if (! is_a($component, LivewireInterface::class)) {
                foreach (Alert::all() as $alerts) {
                    foreach ($alerts as $tag => $alert) {
                        $component->dispatch(
                            'refresh-alert-'.$alert->key(),
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

    }
}
