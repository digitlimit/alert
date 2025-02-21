<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;

class Message extends AbstractMessage implements MessageInterface
{
    /**
     * Create a new normal alert instance.
     *
     * @return void
     */
    public function __construct(
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

    /**
     * Convert the message instance to an array.
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'type' => $this->key(),
            'message' => $this->message,
        ]);
    }

    /**
     * Fill the message alert from an array.
     */
    public static function fill(array $alert): MessageInterface
    {
        return new static($alert['message']);
    }
}
