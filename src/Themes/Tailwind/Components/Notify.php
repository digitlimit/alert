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
     * Set the alerts.
     */
    public function setAlerts(string $tag, array $alerts = []): void
    {
        $alerts = !empty($alerts)
            ? Alert::fromArrays($alerts)
            : Alert::getNotify($tag);

        $this->alerts = $alerts
            ->filter(function ($alert) {
                return $alert->getTag() === $this->tag;
            })
            ->values();
    }


    /**
     * Create a new component instance.
     *
     * @throws Exception
     */
    public function mount(): void
    {
        $this->setAlerts($this->tag);
    }

    #[On('refresh-alert-notify')]
    public function refresh(string $tag, array $alerts): void
    {
        if ($tag !== $this->tag) {
            return;
        }

        $this->setAlerts($tag, array_values($alerts));
        $this->dispatch('open-alert-notify');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $alerts = $this->alerts->map(function ($alert) {
            $alert->forget();
            return $alert->toArray();
        })->toJson();
        
        return view(
            'alert::themes.tailwind.components.notify',
            compact('alerts')
        );
    }
}
