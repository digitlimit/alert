<?php

namespace Digitlimit\Alert\Themes\Tailwind\Components;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * Class Notify
 */
class Notify extends Component implements LivewireInterface
{
    /**
     * The alert tag.
     */
    public string $tag = Alert::DEFAULT_TAG;

    /**
     * The alerts
     */
    protected Collection $alerts;

    /**
     * Create a new component instance.
     *
     * @throws Exception
     */
    public function mount(): void
    {
        $this->alerts = Alert::getNotify($this->tag);
    }

    #[On('refresh-alert-notify')]
    public function refresh(string $tag, Collection $alerts): void
    {
        $this->alerts = $alerts;

        if ($this->tag !== $tag || $alerts->isEmpty()) {
            return;
        }

        $this->dispatch('open-alert-notify');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $alerts = $this->alerts->map(function ($alert) {
            return $alert->toArray();
        })->values()->toJson();

        $this->alerts->each(function ($alert) {
            $alert->forget();
        });

        return view(
            'alert::themes.tailwind.components.notify',
            compact('alerts')
        );
    }
}
