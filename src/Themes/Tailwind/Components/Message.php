<?php

namespace Digitlimit\Alert\Themes\Tailwind\Components;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * Class Message
 */
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
        $this->tag = $this->tag ?? $this->defaultTag;
        $data = Alert::taggedModal($this->tag)?->toArray() ?? [];

        if (empty($data)) {
            $this->skipRender();

            return;
        }

        $this->setUp($data);
    }

    #[On('refresh-alert-message')]
    public function refresh(string $tag, array $data): void
    {
        if ($this->tag !== $tag || empty($data)) {
            return;
        }

        $this->setUp($data);
        $this->dispatch('open-alert-message');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::themes.tailwind.components.message');
    }
}
