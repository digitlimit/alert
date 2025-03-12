<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Contracts\Closable;
use Digitlimit\Alert\Contracts\HasButton;
use Digitlimit\Alert\Contracts\HasMessage;
use Digitlimit\Alert\Contracts\HasTimeout;
use Digitlimit\Alert\Contracts\HasTitle;
use Digitlimit\Alert\Contracts\Levelable;
use Digitlimit\Alert\Contracts\Positionable;
use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Events\Notify\Flashed;
use Digitlimit\Alert\Foundation\AbstractAlert;
use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Traits;
use Exception;

/**
 * Notify alert class.
 */
class Notify extends AbstractAlert implements AlertInterface, Closable, HasButton, HasMessage, HasTimeout, HasTitle, Levelable, Positionable, Taggable
{
    use Traits\Closable;
    use Traits\Levelable;
    use Traits\Positionable;
    use Traits\Taggable;
    use Traits\WithMessage;
    use Traits\WithTimeout;
    use Traits\WithTitle;
    use Traits\WithActionButton;
    use Traits\WithButton;
    use Traits\WithCancelButton;

    protected string $defaultLevel = 'info';

    /**
     * Create a new notify alert instance.
     *
     * @return void
     */
    public function __construct(
        protected string $message
    ) {
        parent::__construct();
    }

    /**
     * Fetch the alert level.
     */
    public function getLevel(): string
    {
        if (empty($this->level)) {
            return $this->defaultLevel;
        }

        return $this->level;
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
            'title' => $this->getTitle(),
            'timeout' => $this->getTimeout(),
            'message' => $this->getMessage(),
            'tag' => $this->getTag(),
            'level' => $this->getLevel(),
            'position' => $this->getPosition(),
            'closable' => $this->isClosable(),
            'buttons' => $this->buttonsToArray(),
        ]);
    }

    /**
     * Fill the notification alert from an array.
     *
     * @throws Exception
     */
    public static function fill(array $alert): AlertInterface
    {
        $notify = new static($alert['message']);
        $notify->id($alert['id']);

        if ($alert['title']) {
            $notify->title($alert['title']);
        }

        $notify->tag($alert['tag']);
        $notify->level($alert['level']);
        $notify->position($alert['position']);
        $notify->timeout($alert['timeout']);
        $notify->closable($alert['closable']);
        $notify->buttons($alert['buttons'] ?? []);

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
