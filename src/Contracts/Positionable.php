<?php

namespace Digitlimit\Alert\Contracts;

use Exception;

interface Positionable
{
    /**
     * Position in the center of the screen.
     */
    public function centered(): self;

    /**
     * Position on the top left of the screen.
     */
    public function topLeft(): self;

    /**
     * Position on the top right of the screen.
     */
    public function topRight(): self;

    /**
     * Position on the top center of the screen.
     */
    public function topCenter(): self;

    /**
     * Position on the bottom left of the screen.
     */
    public function bottomLeft(): self;

    /**
     * Position on the bottom right of the screen.
     */
    public function bottomRight(): self;

    /**
     * Position on the bottom center of the screen.
     */
    public function bottomCenter(): self;

    /**
     * Set the position of alert.
     * @throws Exception
     */
    public function position(string $position): self;

    /**
     * Get the position of the alert.
     */
    public function getPosition(): string;
}
