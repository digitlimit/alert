<?php

namespace Digitlimit\Alert\Themes\Tailwind\Components;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Digitlimit\Alert\Themes\Tailwind\AbstractComponent;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;

/**
 * Class Modal
 */
class Modal extends AbstractComponent implements LivewireInterface
{
    /**
     * The alert tag.
     */
    public string $tag = Alert::DEFAULT_TAG;

    /**
     * The alerts
     */
    public array $alerts = [];

    /**
     * Set the alerts.
     */
    public function resolve(string $tag, array $alerts = []): void
    {
        $alerts = ! empty($alerts)
            ? Alert::fromArrays($alerts)
            : Alert::getModal($tag);

        $this->alerts = $alerts
            ->filter(function ($alert) {
                return $alert->getTag() === $this->tag;
            })
            ->values()
            ->map(function ($alert) {
                $alert->forget();
                $modal = $alert->toArray();

                $modal['action_button'] = $alert->actionButton()?->toArray();
                $modal['cancel_button'] = $alert->cancelButton()?->toArray();
                $modal['custom_buttons'] = $alert->customButtons()
                    ->map(fn ($button) => $button->toArray())
                    ->toArray();

                $modal['has_action_button'] = $modal['action_button'] !== null;
                $modal['has_cancel_button'] = $modal['cancel_button'] !== null;
                $modal['has_custom_buttons'] = count($modal['custom_buttons']);

                return $modal;
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

    #[On('refresh-alert-modal')]
    public function refresh(string $tag, array $alerts): void
    {
        if ($tag !== $this->tag) {
            return;
        }

        $this->resolve($tag, array_values($alerts));
        $this->dispatch('open-alert-modal');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::themes.tailwind.components.modal');
    }
}
