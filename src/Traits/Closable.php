<?php

namespace Digitlimit\Alert\Traits;

trait Closable
{
    protected bool $closable = true;

    public function closable(): self
    {
        $this->closable = true;

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
