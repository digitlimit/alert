<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Session;

class Message extends AbstractMessage implements MessageInterface
{
    /**
     * Create a new nomal alert instance.
     *
     * @return void
     */
    public function __construct(
        protected Session $session,
        public ?string $message
    ) {
        $this->id($this->key() . '-' . Helper::randomString());
    }

    /**
     * Message store key for the message alert.
     */
    public function key(): string
    {
        return 'message';
    }
}
