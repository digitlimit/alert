<?php

namespace Digitlimit\Alert\Traits;

trait Scrollable
{
    protected bool $scrollable = false;

    public function scrollable(): self
    {
        $this->scrollable = true;

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

    public function setScrollable(bool $scrollable): self
    {
        $this->scrollable = $scrollable;

        return $this;
    }
}
