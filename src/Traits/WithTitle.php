<?php

namespace Digitlimit\Alert\Traits;

/**
 * WithTitle trait.
 */
trait WithTitle
{
    protected ?string $title = null;

    /**
     * Set the alert title.
     */
    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Fetch the alert title.
     */
    public function getTitle(): ?string
    {
        return $this->title ?? null;
    }

    public function hasTitle(): bool
    {
        return ! is_null($this->title);
    }
}
