<?php

namespace Digitlimit\Alert\Contracts;

/**
 * Has name contract
 */
interface HasName
{
    /**
     * Set the field name.
     */
    public function name(string $name): self;

    /**
     * Get the field name.
     */
    public function getName(): string;

    /*
     * Check if the field has a name.
     */
    public function hasName(): bool;
}
