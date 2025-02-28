<?php

namespace Digitlimit\Alert\Contracts;

/**
 * Alert message contract
 */
interface HasMessage
{
    /**
     * Set alert message.
     */
    public function message(string $message): self;

    /**
     * Fetch the alert message.
     */
    public function getMessage(): string;
}
