<?php

namespace Digitlimit\Alert\View\Components\Themes\Tailwind;

use Digitlimit\Alert\Alert;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notify extends Component
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
    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::components.themes.tailwind.notify');
    }
}
