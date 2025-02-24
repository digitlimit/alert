<?php

namespace Digitlimit\Alert\Traits;

trait Sizable
{
    /**
     * Set modal size to small.
     */
    public function small(): self
    {
        $this->size = 'small';

        return $this;
    }

    /**
     * Set modal size to medium.
     */
    public function medium(): self
    {
        $this->size = 'medium';

        return $this;
    }

    /**
     * Set modal size to large.
     */
    public function large(): self
    {
        $this->size = 'large';

        return $this;
    }

    /**
     * Set modal size to extra-large.
     */
    public function extraLarge(): self
    {
        $this->size = 'extra-large';

        return $this;
    }

    /**
     * Set modal size to fullscreen.
     */
    public function fullscreen(): self
    {
        $this->size = 'fullscreen';

        return $this;
    }
}
