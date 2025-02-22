<?php

namespace Digitlimit\Alert\Themes\Tailwind;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Message extends Component implements LivewireInterface
{
    /**
     * The default alert tag.
     */
    public string $defaultTag = Alert::DEFAULT_TAG;

    /**
     * The alert tag.
     */
    public string $tag;

    /**
     * The alert
     */
    public array $data = [];

    /**
     * Create a new component instance.
     */
    public function mount()
    {
        $this->tag = $this->tag ?? $this->defaultTag;
        $this->data = Alert::tagged('modal', $this->tag)?->toArray() ?? [];

        if(empty($this->data)) {
            $this->skipRender();
        }
    }

    #[On('refresh-alert-message')]
    public function refresh(string $tag, array $data): void
    {
        if($this->tag !== $tag) {
            return;
        }

        $this->data = $data;
        $this->dispatch('open-alert-message');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::components.themes.tailwind.message');
    }
}
