<?php

namespace Digitlimit\Alert\Contracts;

use Exception;

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
}
