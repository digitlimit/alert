<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Session;

class Form extends AbstractMessage implements MessageInterface
{
    public function __construct(
        protected Session $session, 
        public string $message
    ){}

    public function name(): string
    {
        return 'form';
    }
}