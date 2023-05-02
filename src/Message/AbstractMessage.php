<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Enums\Level;

abstract class AbstractMessage implements MessageInterface
{
    protected string $title = '';

    public function __construct(
        protected string $message,
        protected Level $level  = Level::INFO
    ){}

    public function setLevel(Level $level) : self
    {
        $this->level = $level;
        return $this;
    }

    public function setMessage(string $message) : self
    {
        $this->message = $message;
        return $this;
    }

    public function setTitle(string $title) : self
    {
        $this->title = $title;
        return $this;
    }

    abstract public function name() : string;

    public function level() : string 
    {
        return $this->level->value;
    }

    public function message() : string
    {
        return $this->message;
    }

    public function title() : string
    {
       return $this->title;
    }
}