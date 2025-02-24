<?php

namespace Digitlimit\Alert\Contracts;

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
}
