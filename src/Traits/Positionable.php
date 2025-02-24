<?php

namespace Digitlimit\Alert\Traits;

trait Positionable
{
    /**
     * Position on center of the screen.
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
}
