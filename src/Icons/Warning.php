<?php

namespace Digitlimit\Alert\Icons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Warning extends Component
{
    /**
     * The alert icon is circled.
     */
    public bool $circled = true;

    /**
     * Check if the alert icon is circled.
     *
     * @return bool
     */
    public function isCircled(): bool
    {
        return $this->circled;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('alert::icons.warning');
    }
}
