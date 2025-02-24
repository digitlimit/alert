<?php

namespace Digitlimit\Alert\Message;

interface MessageInterface
{
    /**
     * Set the alert ID.
     */
    public function id(string|int $id): self;

    /**
     * Flash the alert to the session.
     */
    public function flash(): void;

    /**
     * Set the alert icon.
     */
    public function toArray(): array;

    /**
     * Fill the field alert from an array.
     */
    public static function fill(array $alert): self;
}
