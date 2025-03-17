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
 * Class Modal
 */
class Modal extends Component implements LivewireInterface
{
    /**
     * The alert tag.
     */
    public string $tag = Alert::DEFAULT_TAG;

    /**
     * The alert
     */
    public array $data = [];

    /**
     * @throws Exception
     */
    public function mount(): void
    {
        $this->data = Alert::getModal($this->tag)?->toArray() ?? [];

        if (empty($this->data)) {
            $this->skipRender();
        }
    }

    #[On('refresh-alert-modal')]
    public function refresh(string $tag, Collection $alerts): void
    {
        if ($this->tag !== $tag || $alerts->isEmpty()) {
            return;
        }

        $this->alerts = $alerts;
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
