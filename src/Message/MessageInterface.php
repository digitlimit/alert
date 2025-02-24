<?php

namespace Digitlimit\Alert\Message;

interface MessageInterface
{
    /**
     * Set the alert ID.
     */
    public function id(string|int $id): self;

    /**
     * Set the alert message.
     */
    public function message(string $message): self;

    /**
     * Set the alert title.
     */
    public function title(string $title): self;

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
