<?php

namespace Digitlimit\Alert\Contracts;

use Exception;

interface Sizable
{
    /**
     * Set modal size to small.
     */
    public function small(): self;

    /**
     * Set modal size to medium.
     */
    public function medium(): self;

    /**
     * Set modal size to large.
     */
    public function large(): self;

    /**
     * Set modal size to extra-large.
     */
    public function extraLarge(): self;

    /**
     * Set modal size to fullscreen.
     */
    public function fullscreen(): self;

    /**
     * Set modal size
     *
     * @throws Exception
     */
    public function size(string $size): self;

    /**
     * Get the size of the alert
     */
    public function getSize(): string;
}
