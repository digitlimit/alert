<?php

namespace Digitlimit\Alert\Contracts;

interface Positionable
{
    /**
     * Position on the center of the screen.
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
}
