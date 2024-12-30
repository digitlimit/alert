<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\SessionInterface;

class Message extends AbstractMessage implements MessageInterface
{
    /**
     * Create a new normal alert instance.
     *
     * @return void
     */
    public function __construct(
        protected SessionInterface $session,
        public string $message
    ) {
        $this->id($this->key().'-'.Helper::randomString());
    }

    /**
     * Message store key for the message alert.
     */
    public function key(): string
    {
        return 'message';
    }
}
