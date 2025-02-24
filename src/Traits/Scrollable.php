<?php

namespace Digitlimit\Alert\Traits;

trait Scrollable
{
    public function scrollable(): self 
    {
        $this->scrollable = true;

        return $this;
    }
}
