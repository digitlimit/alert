<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Contracts\Levelable;

use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Events\Message\Flashed;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Traits;

class Message extends AbstractMessage implements MessageInterface, Levelable, Taggable
{
    use Traits\Levelable;
    use Traits\Taggable;

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
            'tag' => $this->getTag(),
            'message' => $this->getMessage(),
            'title' => $this->getTitle(),
            'level' => $this->getLevel(),
        ]);
    }

    /**
     * Fill the message alert from an array.
     */
    public static function fill(array $alert): MessageInterface
    {
        $message = new static($alert['message']);

        $message->id($alert['id']);
        $message->tag($alert['tag']);
        $message->level($alert['level']);

        if ($alert['title']) {
            $message->title($alert['title']);
        }

        return $message;
    }

    /**
     * Flash field instance to store.
     */
    public function flash(): void
    {
        parent::flash();

        Flashed::dispatch($this);
    }
}
