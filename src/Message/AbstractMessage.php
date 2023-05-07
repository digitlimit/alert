<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Session;
use Digitlimit\Alert\Traits\Levelable;
use Digitlimit\Alert\Helpers\SessionKey;

abstract class AbstractMessage implements MessageInterface
{
    use Levelable;

    protected Session $session;

    public string $message = '';
    public string $title   = '';
    public string $level   = '';
    protected string $tag  = 'default';

    abstract public function name() : string;

    public function level(string $level) : self
    {
        $this->level = $level;
        return $this;
    }

    public function message(string $message) : self
    {
        $this->message = $message;
        return $this;
    }

    public function title(string $title) : self
    {
        $this->title = $title;
        return $this;
    }

    public function tag(string $tag) : self
    {
        $this->tag = $tag;
        return $this;
    }

    public function flash(string $message='', string $level='') : void 
    {
        $this->message = $message ? $message : $this->message;
        $this->level   = $level   ? $level   : $this->level;

        $sessionKey = SessionKey::key($this->name(), $this->tag); 
        $this->session->flash($sessionKey, $this);
    }
}