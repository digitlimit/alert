<?php

namespace Digitlimit\Alert\Contracts;

interface HasTimeout
{
    /*
     * Set timeout for the alert.
     */
    public function timeout(int $timeout): self;

    /*
     * Check if the field has a name.
     */
    public function hasTimeout(): bool;

    /*
     * Get the alert timeout.
     */
    public function getTimeout(): int;
}
