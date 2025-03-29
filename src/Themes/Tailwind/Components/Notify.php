<?php

namespace Digitlimit\Alert\Themes\Tailwind\Components;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Digitlimit\Alert\Themes\Tailwind\AbstractComponent;
use Illuminate\Support\Str;

/**
 * Class Notify
 */
class Notify extends AbstractComponent implements LivewireInterface
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
        $alerts = !empty($alerts)
            ? Alert::fromArrays($alerts)
            : Alert::getNotify($tag);

        $this->alerts = $alerts
            ->filter(function ($alert) {
                return $alert->getTag() === $this->tag;
            })
            ->values()
            ->map(function ($alert) {
                $alert->forget();
                $notify = $alert->toArray();

                $notify['action_button'] = $alert->actionButton()?->toArray();
                $notify['cancel_button'] = $alert->cancelButton()?->toArray();
                $notify['custom_buttons'] = $alert->customButtons()
                    ->map(fn ($button) => $button->toArray())
                    ->toArray();

                $notify['has_action_button'] = $notify['action_button'] !== null;
                $notify['has_cancel_button'] = $notify['cancel_button'] !== null;
                $notify['has_custom_buttons'] = count($notify['custom_buttons']);

                return $notify;
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

    #[On('refresh-alert-notify')]
    public function refresh(string $tag, array $alerts): void
    {
        if ($tag !== $this->tag) {
            return;
        }

        $this->resolve($tag, array_values($alerts));
        $this->dispatch('open-alert-notify');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::themes.tailwind.components.notify');
    }
}
