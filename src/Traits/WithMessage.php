<?php

namespace Digitlimit\Alert\Traits;

/**
 * WithMessage trait.
 */
trait WithMessage
{
    /**
     * The alert message.
     */
    protected string $message;

    /**
     * Set alert message.
     */
    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Fetch the alert message.
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
