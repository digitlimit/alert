<?php

namespace Digitlimit\Alert\Contracts;

/**
 * Alert closable contract
 */
interface Closable
{
    /**
     * Set the alert to be closable
     *
     * @return $this
     */
    public function closable(bool $closable): self;

    /**
     * Set the alert to be not closable
     *
     * @return $this
     */
    public function notClosable(): self;

    /**
     * Check if the alert is closable
     *
     * @return bool
     */
    public function isClosable(): bool;
}
