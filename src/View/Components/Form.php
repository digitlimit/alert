<?php

namespace Digitlimit\Alert\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Digitlimit\Alert\Alert;

class Form extends Component
{
    public string $defaultTag = 'default';

    public Alert $alert;

    /**
     * Create a new component instance.
     */
    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }

    /**
     * Whether the component should be rendered
     */
    // public function shouldRender(): bool
    // {

    // }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('alert::components.form');
    }
}