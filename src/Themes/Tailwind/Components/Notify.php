<?php

namespace Digitlimit\Alert\Themes\Tailwind\Components;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * Class Toastr
 */
class Toastr extends Component implements LivewireInterface
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
        $data = Alert::getToastr($this->tag)?->toArray() ?? [];

        if (empty($data)) {
            $this->skipRender();

            return;
        }

        $this->setUp($data);
    }

    #[On('refresh-alert-toastr')]
    public function refresh(string $tag, array $data): void
    {
        if ($this->tag !== $tag || empty($data)) {
            return;
        }

        $this->setUp($data);
        $this->dispatch('open-alert-toastr');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::themes.tailwind.components.toastr');
    }
}
