<?php

namespace Digitlimit\Alert\Contracts;

interface HasTitle
{
    /**
     * Set the alert title.
     */
    public function title(string $title): self;

    /**
     * Fetch the alert title.
     */
    public function getTitle(): ?string;

    /**
     * Determine if the alert has a title.
     */
    public function hasTitle(): bool;
}
