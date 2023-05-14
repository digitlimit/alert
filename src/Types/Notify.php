<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Session;

class Notify extends AbstractMessage implements MessageInterface
{
    public string $position;

    public function __construct(
        protected Session $session, 
        public ?string $message
    ) {}
    
    public function key(): string
    {
        return 'notify';
    }

    public function centered(string $class='top-50 start-50 translate-middle') : self 
    {
        $this->position = $class;
        return $this;
    }
    
    public function topLeft(string $class='top-0 start-0') : self 
    {
        $this->position = $class;
        return $this;
    }

    public function topRight(string $class='top-0 end-0') : self 
    {
        $this->position = $class;
        return $this;
    }

    public function topCenter(string $class='top-0 start-50 translate-middle-x') : self 
    {
        $this->position = $class;
        return $this;
    }

    public function bottomLeft(string $class='bottom-0 start-0') : self 
    {
        $this->position = $class;
        return $this;
    }

    public function bottomRight(string $class='bottom-0 end-0') : self 
    {
        $this->position = $class;
        return $this;
    }

    public function bottomCenter(string $class='bottom-0 start-50 translate-middle-x') : self 
    {
        $this->position = $class;
        return $this;
    }
}