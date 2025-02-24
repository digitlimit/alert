<?php

namespace Digitlimit\Alert\Contracts;

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
