<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Session;

class Notify extends AbstractMessage implements MessageInterface
{
    /**
     * The position of the notify.
     */
    public ?string $position = null;

    /**
     * Create a new notify alert instance.
     *
     * @return void
     */
    public function __construct(
        protected Session $session,
        public ?string $message
    ) {
        $this->id(Helper::randomString());
        $this->bottomRight();
    }

    /**
     * Message store key for the notify alert.
     */
    public function key(): string
    {
        return 'notify';
    }

    /**
     * Position notify on center of the screen.
     */
    public function centered(string $class = 'top-50 start-50 translate-middle'): self
    {
        $this->position = $class;

        return $this;
    }

    /**
     * Position notify on the center of the screen.
     */
    public function topLeft(string $class = 'top-0 start-0'): self
    {
        $this->position = $class;

        return $this;
    }

    /**
     * Position notify on the top right of the screen.
     */
    public function topRight(string $class = 'top-0 end-0'): self
    {
        $this->position = $class;

        return $this;
    }

    /**
     * Position notify on the top center of the screen.
     */
    public function topCenter(string $class = 'top-0 start-50 translate-middle-x'): self
    {
        $this->position = $class;

        return $this;
    }

    /**
     * Position notify on the bottom left of the screen.
     */
    public function bottomLeft(string $class = 'bottom-0 start-0'): self
    {
        $this->position = $class;

        return $this;
    }

    /**
     * Position notify on the bottom right of the screen.
     */
    public function bottomRight(string $class = 'bottom-0 end-0'): self
    {
        $this->position = $class;

        return $this;
    }

    /**
     * Position notify on the bottom center of the screen.
     */
    public function bottomCenter(string $class = 'bottom-0 start-50 translate-middle-x'): self
    {
        $this->position = $class;

        return $this;
    }
}
