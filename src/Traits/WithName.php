<?php

namespace Digitlimit\Alert\Traits;

/**
 * WithName trait.
 */
trait WithName
{
    protected string $name;

    /**
     * Set the field name.
     */
    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the field name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /*
    * Check if the field has a name.
    */
    public function hasName(): bool
    {
        return isset($this->name);
    }
}
