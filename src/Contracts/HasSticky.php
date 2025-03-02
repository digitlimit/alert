<?php

namespace Digitlimit\Alert\Contracts;

/**
 * The interface for sticky alerts.
 */
interface HasSticky
{
    /**
     * Set the sticky property.
     */
    public function sticky(bool $sticky = true): self;

    /**
     * Check if the alert is sticky.
     */
    public function isSticky(): bool;

    /**
     * Flash the alert to the session.
     */
    public function flashSticky(): self;
}
