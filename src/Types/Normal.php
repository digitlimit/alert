<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Session;
use Digitlimit\Alert\Helpers\Helper;

class Normal extends AbstractMessage implements MessageInterface
{
    public function __construct(
        protected Session $session, 
        public ?string $message
    ){
        $this->id(Helper::randomString());
    }

    public function key(): string
    {
        return 'normal';
    }
}