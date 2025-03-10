<?php

namespace Digitlimit\Alert\Themes\Tailwind\Components;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\MessageBag;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * Class Field
 */
class Field extends Component implements LivewireInterface
{
    /**
     * The alias for named alert.
     */
    public string $for;

    /**
     * The alert name
     */
    public string $name;

    /**
     * The alert tag.
     */
    public string $tag = Alert::DEFAULT_TAG;

    /**
     * The alert
     */
    public array $data = [];

    /**
     * Set data for the alert.
     */
    public function setUp(array $data): void
    {
        $this->data = $data;
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

        if (! empty($this->name) && ! empty($this->tag)) {
            $data = Alert::namedField($this->name, $this->tag)?->toArray();

            if (! empty($data)) {
                $this->setUp($data);
            }
        }
    }

    #[On('refresh-alert-field')]
    public function refresh(string $tag, array $data): void
    {
        if (empty($data) || empty($this->name)) {
            return;
        }

        if ($this->tag !== $tag || $this->name !== $data['name']) {
            return;
        }

        $this->setUp($data);
        $this->dispatch('open-alert-field');
    }

    /**
     * Get Laravel errors.
     */
    public function getViewErrors(): MessageBag
    {
        $errors = session('errors');

        return $errors instanceof MessageBag
            ? $errors
            : new MessageBag;
    }

    /**
     * Get tagged view errors.
     */
    public function getTaggedViewErrors(string $tag): MessageBag
    {
        return $this->getViewErrors()->{$tag} ?? new MessageBag;
    }

    public function getViewFieldError(string $name, string $tag): ?string
    {
        $taggedErrors = $this->getTaggedViewErrors($tag);

        if ($taggedErrors->has($name)) {
            return $taggedErrors->first($name);
        }

        $viewErrors = $this->getViewErrors();

        if ($viewErrors->has($name)) {
            return $viewErrors->first($name);
        }

        return null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::themes.tailwind.components.field', [
            'error' => $this->getViewFieldError($this->name, $this->tag),
        ]);
    }
}
