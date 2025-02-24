<?php

namespace Digitlimit\Alert\Traits;

trait Closable
{
    protected bool $closable = false;

    public function closable(): self
    {
        $this->closable = true;

        return $this;
    }

    public function unClosable(): self
    {
        $this->closable = false;

        return $this;
    }

    public function isClosable(): bool
    {
        return $this->closable;
    }
}
