<?php

namespace Digitlimit\Alert\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Digitlimit\Alert\Alert;

class Bar extends Component
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
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('alert::components.bar');
    }
}