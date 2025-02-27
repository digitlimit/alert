<?php

namespace Digitlimit\Alert\Message;

interface MessageInterface
{
    /**
     * Set the alert ID.
     */
    public function id(string|int $id): self;

    /**
     * Set alert ID to auto generate.
     */
    public function autoSetId(): self;

    /**
     * Fetch the alert ID.
     */
    public function getId(): string|int;

    /**
     * Flash the alert to the session.
     */
    public function flash(): void;

    /**
     * Forget the alert from the store.
     */
    public function forget(?string $tag = null): self;

    /**
     * Set the alert icon.
     */
    public function toArray(): array;

    /**
     * Fill the field alert from an array.
     */
    public static function fill(array $alert): self;
}
