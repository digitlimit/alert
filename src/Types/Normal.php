<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Session;
use Digitlimit\Alert\Helpers\Helper;

class Normal extends AbstractMessage implements MessageInterface
{
    /**
     * Create a new nomal alert instance.
     * @return void
     */
    public function __construct(
        protected Session $session, 
        public ?string $message
    ){
        $this->id(Helper::randomString());
    }

    /**
     * Message store key for the normal alert
     */
    public function key(): string
    {
        return 'normal';
    }
}