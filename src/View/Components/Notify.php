<?php

namespace Digitlimit\Alert\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Digitlimit\Alert\Alert;
use Illuminate\Support\Str;

class Notify extends Component
{
    public string $id;

    public string $defaultTag = 'default';

    public Alert $alert;

    /**
     * Create a new component instance.
     */
    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
        $this->id    = 'notify' . Str::random(10);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('alert::components.notify');
    }
}
