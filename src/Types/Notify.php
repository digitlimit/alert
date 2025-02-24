<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Contracts\Levelable;
use Digitlimit\Alert\Contracts\Positionable;
use Digitlimit\Alert\Events\Notify\Flashed;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;

use Digitlimit\Alert\Traits;
use Exception;

class Notify extends AbstractMessage implements MessageInterface, Levelable, Positionable
{
    use Traits\Levelable;
    use Traits\Positionable;

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
            'message' => $this->message,
            'position' => $this->position,
        ]);
    }

    /**
     * Fill the notification alert from an array.
     * @throws Exception
     */
    public static function fill(array $alert): MessageInterface
    {
        $notify = new static($alert['message']);
        $notify->id($alert['id']);
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
