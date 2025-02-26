<?php

namespace Digitlimit\Alert\Contracts;

/**
 * The alert tag contract.
 */
interface Taggable
{
    /**
     * Set the alert tag.
     */
    public function tag(string $tag): self;

    /**
     * Get the alert tag.
     */
    public function getTag(): string;

    /**
     * Check if the default tag is set.
     */
    public function isDefaultTag(): bool;
}
