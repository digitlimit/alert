<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Contracts\Levelable;
use Digitlimit\Alert\Contracts\Positionable;
use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Events\Notify\Flashed;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Traits;
use Exception;

class Notify extends AbstractMessage implements Levelable, MessageInterface, Positionable, Taggable
{
    use Traits\Levelable;
    use Traits\Positionable;
    use Traits\Taggable;

    /**
     * Create a new notify alert instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $message
    ) {
        $this->id($this->key().'-'.Helper::randomString());
        $this->bottomRight();
    }

    /**
     * Message store key for the notify alert.
     */
    public function key(): string
    {
        return 'notify';
    }

    /**
     * Convert the notify alert to an array.
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'type' => $this->key(),
            'message' => $this->getMessage(),
            'tag' => $this->getTag(),
            'level' => $this->getLevel(),
            'position' => $this->getPosition(),
        ]);
    }

    /**
     * Fill the notification alert from an array.
     *
     * @throws Exception
     */
    public static function fill(array $alert): MessageInterface
    {
        $notify = new static($alert['message']);
        $notify->id($alert['id']);

        if ($alert['title']) {
            $notify->title($alert['title']);
        }

        $notify->tag($alert['tag']);
        $notify->level($alert['level']);
        $notify->position($alert['position']);

        return $notify;
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
