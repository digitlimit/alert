<?php

namespace Digitlimit\Alert\Traits;

/**
 * Scrollable trait.
 */
trait Scrollable
{
    protected bool $scrollable = true;

    public function scrollable(bool $scrollable): self
    {
        $this->scrollable = $scrollable;

        return $this;
    }

    public function notScrollable(): self
    {
        $this->scrollable = false;

        return $this;
    }

    public function isScrollable(): bool
    {
        return $this->scrollable;
    }
}
