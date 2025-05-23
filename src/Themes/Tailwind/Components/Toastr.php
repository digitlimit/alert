<?php

namespace Digitlimit\Alert\Themes\Tailwind\Components;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Digitlimit\Alert\Themes\Tailwind\AbstractComponent;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;

/**
 * Class Toastr.
 */
class Toastr extends AbstractComponent implements LivewireInterface
{
    /**
     * The alert tag.
     */
    public string $tag = Alert::DEFAULT_TAG;

    /**
     * The alerts.
     */
    public array $alerts = [];

    /**
     * Set the alerts.
     */
    public function resolve(string $tag, array $alerts = []): void
    {
        $alerts = !empty($alerts)
            ? Alert::fromArrays($alerts)
            : Alert::getToastr($tag);

        $this->alerts = $alerts
            ->filter(function ($alert) {
                return $alert->getTag() === $this->tag;
            })
            ->values()
            ->map(function ($alert) {
                $alert->forget();

                return $alert->toArray();
            })->toArray();
    }

    /**
     * Create a new component instance.
     *
     * @throws Exception
     */
    public function mount(): void
    {
        $this->resolve($this->tag);
    }

    #[On('refresh-alert-toastr')]
    public function refresh(string $tag, array $alerts): void
    {
        if ($tag !== $this->tag) {
            return;
        }

        $this->resolve($tag, array_values($alerts));
        $this->dispatch('open-alert-toastr');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::themes.tailwind.components.toastr');
    }
}
