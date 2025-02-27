<?php

namespace Digitlimit\Alert\Themes\Tailwind;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * Class Notify
 * @package Digitlimit\Alert\Themes\Tailwind
 */
class Notify extends Component implements LivewireInterface
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
        $data = Alert::taggedNotify($this->tag)?->toArray() ?? [];

        if (empty($data)) {
            $this->skipRender();
            return;
        }

        $this->setUp($data);
    }

    #[On('refresh-alert-notify')]
    public function refresh(string $tag, array $data): void
    {
        if ($this->tag !== $tag || empty($data)) {
            return;
        }

        $this->setUp($data);
        $this->dispatch('open-alert-notify');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::components.themes.tailwind.notify');
    }
}
