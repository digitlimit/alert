<?php

namespace Digitlimit\Alert\Traits;

use Exception;
use Illuminate\Support\Str;

/**
 * Sizable trait.
 */
trait Sizable
{
    /**
     * The size of the alert.
     */
    protected string $size = 'medium';

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

    /**
     * Set modal size.
     *
     * @throws Exception
     */
    public function size(string $size): self
    {
        $method = Str::camel($size);

        // check if function exists
        if (!method_exists($this, $method)) {
            throw new Exception("Size {$method} is not supported.");
        }

        return $this->{$this->size}();
    }

    /**
     * Get the size of the alert.
     */
    public function getSize(): string
    {
        return $this->size;
    }
}
