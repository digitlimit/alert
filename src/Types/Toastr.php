<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Contracts\Closable;
use Digitlimit\Alert\Contracts\HasMessage;
use Digitlimit\Alert\Contracts\HasTimeout;
use Digitlimit\Alert\Contracts\HasTitle;
use Digitlimit\Alert\Contracts\Levelable;
use Digitlimit\Alert\Contracts\Positionable;
use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Events\Toastr\Flashed;
use Digitlimit\Alert\Foundation\AbstractAlert;
use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Traits;
use Exception;

/**
 * Toastr alert class.
 */
class Toastr extends AbstractAlert implements AlertInterface, Closable, HasMessage, HasTimeout, HasTitle, Levelable, Positionable, Taggable
{
    use Traits\Closable;
    use Traits\Levelable;
    use Traits\Positionable;
    use Traits\Taggable;
    use Traits\WithMessage;
    use Traits\WithTimeout;
    use Traits\WithTitle;

    protected string $defaultLevel = 'info';

    /**
     * Create a new toastr alert instance.
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
     * Message store key for the toastr alert.
     */
    public function key(): string
    {
        return 'toastr';
    }

    /**
     * Convert the toastr alert to an array.
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'type'     => $this->key(),
            'title'    => $this->getTitle(),
            'timeout'  => $this->getTimeout(),
            'message'  => $this->getMessage(),
            'tag'      => $this->getTag(),
            'level'    => $this->getLevel(),
            'position' => $this->getPosition(),
            'closable' => $this->isClosable(),
        ]);
    }

    /**
     * Fill the notification alert from an array.
     *
     * @throws Exception
     */
    public static function fill(array $alert): AlertInterface
    {
        $toastr = new static($alert['message']);
        $toastr->id($alert['id']);

        if ($alert['title']) {
            $toastr->title($alert['title']);
        }

        $toastr->tag($alert['tag']);
        $toastr->level($alert['level']);
        $toastr->position($alert['position']);
        $toastr->timeout($alert['timeout']);
        $toastr->closable($alert['closable']);

        return $toastr;
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
