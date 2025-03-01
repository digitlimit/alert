<?php

namespace Digitlimit\Alert\Traits;

/**
 * WithTimeout trait.
 */
trait WithTimeout
{
    /**
     * The alert timeout.
     */
    protected int $timeout = 2000;

    /*
    * Set timeout for the alert.
    */
    public function timeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /*
     * Get the alert timeout.
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /*
     * Check if the field has a name.
     */
    public function hasTimeout(): bool
    {
        return isset($this->timeout);
    }
}
