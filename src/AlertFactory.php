<?php

namespace Digitlimit\Alert;

class AlertFactory
{
    public function __construct(
        protected Message $message
    ){}

    public function setMessage(Message $message) : self
    {
        $this->message = $message;
        return $this;
    }

    public function getMessage() : Message
    {
        return $this->message;
    }

    
}
