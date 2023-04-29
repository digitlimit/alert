<?php

namespace Digitlimit\Alert;

class Message
{
    public function __construct(
        protected string $title   = '',
        protected string $content = ''
    ){}

    public function setTitle(string $title) : self
    {
        $this->title = $title;

        return $this;
    }

    public function setContent(string $content) : self
    {
        $this->content = $content;
        
        return $this;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getContent() : string
    {
       return $this->content;
    }

    public function hasTitle() : bool
    {
        return !empty($this->title);
    }

    public function hasContent() : bool
    {
        return !empty($this->content);
    }
}