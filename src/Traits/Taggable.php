<?php

namespace Digitlimit\Alert\Traits;

use Digitlimit\Alert\Alert;

/**
 * Taggable trait.
 */
trait Taggable
{
    protected string $tag = Alert::DEFAULT_TAG;

    /**
     * Set the alert tag.
     */
    public function tag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get the alert tag.
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * Check if the default tag is set.
     */
    public function isDefaultTag(): bool
    {
        return $this->tag === Alert::DEFAULT_TAG;
    }
}
