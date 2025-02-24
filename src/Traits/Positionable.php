<?php

namespace Digitlimit\Alert\Traits;

use Exception;
use Illuminate\Support\Str;

trait Positionable
{
    /**
     * The position of the alert.
     */
    protected string $position = 'top-right';

    /**
     * Position in the center of the screen.
     */
    public function centered(): self
    {
        $this->position = 'centered';

        return $this;
    }

    /**
     * Position on the top left of the screen.
     */
    public function topLeft(): self
    {
        $this->position = 'top-left';

        return $this;
    }

    /**
     * Position on the top right of the screen.
     */
    public function topRight(): self
    {
        $this->position = 'top-right';

        return $this;
    }

    /**
     * Position on the top center of the screen.
     */
    public function topCenter(): self
    {
        $this->position = 'top-center';

        return $this;
    }

    /**
     * Position on the bottom left of the screen.
     */
    public function bottomLeft(): self
    {
        $this->position = 'bottom-left';

        return $this;
    }

    /**
     * Position on the bottom right of the screen.
     */
    public function bottomRight(): self
    {
        $this->position = 'bottom-right';

        return $this;
    }

    /**
     * Position on the bottom center of the screen.
     */
    public function bottomCenter(): self
    {
        $this->position = 'bottom-center';

        return $this;
    }

    /**
     * Set the position of alert.
     *
     * @throws Exception
     */
    public function position(string $position): self
    {
        $method = Str::camel($position);

        // check if function exists
        if (! method_exists($this, $method)) {
            throw new Exception("Position method {$method} does not exist.");
        }

        return $this->{$this->position}();
    }

    /**
     * Get the position of the alert.
     */
    public function getPosition(): string
    {
        return $this->position;
    }
}
