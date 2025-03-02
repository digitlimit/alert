<?php

namespace Digitlimit\Alert\Traits;

/**
 * Closable trait.
 */
trait Closable
{
    protected bool $closable = true;

    public function closable(bool $closable): self
    {
        $this->closable = $closable;

        return $this;
    }

    public function notClosable(): self
    {
        $this->closable = false;

        return $this;
    }

    public function isClosable(): bool
    {
        return $this->closable;
    }
}
