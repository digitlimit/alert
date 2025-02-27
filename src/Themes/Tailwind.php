<?php

namespace Digitlimit\Alert\Themes;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\HasName;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Digitlimit\Alert\Contracts\ThemeInterface;
use Digitlimit\Alert\Contracts\Taggable;
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
    }

    /**
     *  Register the alert types
     */
    public function types(): array
    {
        return config('alert.tailwind.types');
    }

    /**
     * Register the alert components
     */
    public function registerComponents(): void
    {
        $types = $this->types();

        foreach($types as $type) {
            Livewire::component($type['view'], $type['component']);
        }
    }

    /**
     * Dehydrate the alert to the component
     */
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
                        $this->dispatch($component, $alert);
                        continue;
                    }

                    // For multiple alerts, usually from a field
                    foreach ($alert as $field) {
                        $this->dispatch($component, $field);
                    }
                }
            }

            return $component;
        });
    }

    /**
     * Dispatch the alert to the component
     */
    protected function dispatch(
        Component $component,
        MessageInterface|Taggable $alert
    ): void {
        $event = 'refresh-alert-'.$alert->key();

        if ($alert instanceof HasName) {
            $event .= '.'.$alert->getName();
        }

        $component->dispatch(
            $event,
            $alert->getTag(),
            $alert->toArray()
        );
    }
}
