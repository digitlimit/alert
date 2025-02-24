<?php

namespace Digitlimit\Alert\Contracts;

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
