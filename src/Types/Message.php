<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Contracts\Closable;
use Digitlimit\Alert\Contracts\HasMessage;
use Digitlimit\Alert\Contracts\HasSticky;
use Digitlimit\Alert\Contracts\HasTitle;
use Digitlimit\Alert\Contracts\HasTimeout;
use Digitlimit\Alert\Contracts\Levelable;
use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Events\Message\Flashed;
use Digitlimit\Alert\Foundation\AbstractAlert;
use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Traits;

/**
 * Message alert class.
 */
class Message extends AbstractAlert implements AlertInterface, Closable, HasMessage, HasSticky, HasTimeout, HasTitle, Levelable, Taggable
{
    use Traits\Closable;
    use Traits\Levelable;
    use Traits\Taggable;
    use Traits\WithMessage;
    use Traits\WithSticky;
    use Traits\WithTitle;
    use Traits\WithTimeout;

    /**
     * The default level of the alert.
     */
    protected string $defaultLevel = 'info';

    /**
     * Create a new normal alert instance.
     *
     * @return void
     */
    public function __construct(
        protected string $message
    ) {
        $this->timeout(0);
        parent::__construct();
    }

    /**
     * Message store key for the message alert.
     */
    public function key(): string
    {
        return 'message';
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
     * Convert the message instance to an array.
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'type' => $this->key(),
            'tag' => $this->getTag(),
            'level' => $this->getLevel(),
            'message' => $this->getMessage(),
            'title' => $this->getTitle(),
            'timeout' => $this->getTimeout(),
            'closable' => $this->isClosable(),
            'sticky' => $this->isSticky(),
        ]);
    }

    /**
     * Fill the message alert from an array.
     */
    public static function fill(array $alert): AlertInterface
    {
        $message = new static($alert['message']);

        $message->id($alert['id']);
        $message->tag($alert['tag']);
        $message->level($alert['level']);
        $message->closable($alert['closable'] ?? false);
        $message->sticky($alert['sticky'] ?? false);

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
        if ($this->isSticky()) {
            $this->flashSticky();

            return;
        }

        parent::flash();
        Flashed::dispatch($this);
    }
}
