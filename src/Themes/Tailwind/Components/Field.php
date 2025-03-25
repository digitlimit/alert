<?php

namespace Digitlimit\Alert\Themes\Tailwind\Components;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Digitlimit\Alert\Helpers\ValidationError;
use Digitlimit\Alert\Types\Field as FieldAlert;

/**
 * Class Field
 */
class Field extends Component implements LivewireInterface
{
    /**
     * The alias for named alert.
     */
    public ?string $for = null;

    /**
     * The alert name
     */
    public ?string $name = null;

    /**
     * The alerts
     */
    protected ?FieldAlert $alert = null;

    /**
     * The alert tag.
     */
    public string $tag = Alert::DEFAULT_TAG;

    /**
     * Set the alerts.
     */
    public function setAlert(string $tag, array $alert = []): void
    {
        $this->alert = !empty($alert)
            ? Alert::fromArray($alert)
            : Alert::getField($tag, $this->name);
    }

    /**
     * Create a new component instance.
     *
     * @throws Exception
     */
    public function mount(): void
    {
        if (! empty($this->for)) {
            $this->name = $this->for;
        }

        if (empty($this->name)) {
            return;
        }

        $this->setAlert($this->tag);
    }

    #[On('refresh-alert-field')]
    public function refresh(string $tag, array $alerts): void
    {
        $alert = $alerts[$this->name] ?? null;

        if (!is_array($alert) || $tag !== $this->tag) {
            return;
        }

        $this->setAlert($tag, $alert);
        $this->dispatch('open-alert-field');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $alert = null;

        if ($this->alert) {
            $alert = $this->alert->toJson();
            $this->alert->forget();
        }

        return view('alert::themes.tailwind.components.field', [
            'alert' => null //$this->getViewFieldError($this->name, $this->tag),
        ]);
    }
}
