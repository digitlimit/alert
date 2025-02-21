<?php

namespace Digitlimit\Alert\Themes\Tailwind;

use Digitlimit\Alert\Alert;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Message extends Component
{
    /**
     * Set the default tag.
     */
    public string $defaultTag = Alert::DEFAULT_TAG;

    /**
     * Alert instance.
     */
    public Alert $alert;

    /**
     * Create a new component instance.
     */
    public function mount(Alert $alert)
    {
        $this->alert = $alert;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::components.themes.tailwind.message');
    }
}
