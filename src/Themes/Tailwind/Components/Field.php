<?php

namespace Digitlimit\Alert\Themes\Tailwind\Components;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Digitlimit\Alert\Themes\Tailwind\AbstractComponent;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;

/**
 * Class Field.
 */
class Field extends AbstractComponent implements LivewireInterface
{
    /**
     * The alias for named alert.
     */
    public ?string $for = null;

    /**
     * The alert name.
     */
    public ?string $name = null;

    /**
     * The alerts.
     */
    public array $alert = [];

    /**
     * The alert tag.
     */
    public string $tag = Alert::DEFAULT_TAG;

    /**
     * Create a new component instance.
     *
     * @throws Exception
     */
    public function mount(): void
    {
        if (!empty($this->for)) {
            $this->name = $this->for;
        }

        if (empty($this->name)) {
            return;
        }

        $this->resolve($this->tag);
    }

    #[On('refresh-alert-field')]
    public function refresh(string $tag, array $alerts): void
    {
        $alert = $alerts[$this->name] ?? [];

        if ($tag !== $this->tag) {
            return;
        }

        $this->resolve($tag, $alert);
        $this->dispatch('open-alert-field');
    }

    /**
     * Set the alerts.
     */
    public function resolve(string $tag, array $alert = []): void
    {
        $alert = !empty($alert)
            ? Alert::fromArray($alert)
            : Alert::getField($tag, $this->name);

        if (empty($alert)) {
            return;
        }

        $alert->forget();
        $this->alert = $alert->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::themes.tailwind.components.field');
    }
}
