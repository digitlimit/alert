<?php

namespace Digitlimit\Alert\Themes\Tailwind\Components;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Types\Field as FieldMessage;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Digitlimit\Alert\Helpers\ValidationError;

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
     * The alert
     */
    protected ?FieldMessage $alert = null;

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
        if (! empty($this->for)) {
            $this->name = $this->for;
        }

        if (empty($this->name)) {
            return;
        }

        $this->alert = Alert::getField($this->name, $this->tag);
    }

    #[On('refresh-alert-field')]
    public function refresh(string $tag, Collection $alerts): void
    {
        $this->alerts = $alerts;

        $this->dispatch('open-alert-field');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::themes.tailwind.components.field', [
            'alert' => null //$this->getViewFieldError($this->name, $this->tag),
        ]);
    }
}
