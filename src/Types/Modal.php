<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Contracts\Closable;
use Digitlimit\Alert\Contracts\HasButton;
use Digitlimit\Alert\Contracts\HasMessage;
use Digitlimit\Alert\Contracts\HasTitle;
use Digitlimit\Alert\Contracts\HasView;
use Digitlimit\Alert\Contracts\Levelable;
use Digitlimit\Alert\Contracts\Scrollable;
use Digitlimit\Alert\Contracts\Sizable;
use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Events\Modal\Flashed;
use Digitlimit\Alert\Foundation\AbstractAlert;
use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Traits;
use Exception;
use Throwable;

/**
 * Modal alert class.
 */
class Modal extends AbstractAlert implements AlertInterface, Closable, HasButton, HasMessage, HasTitle, HasView, Levelable, Scrollable, Sizable, Taggable
{
    use Traits\Closable;
    use Traits\Levelable;
    use Traits\Scrollable;
    use Traits\Sizable;
    use Traits\Taggable;
    use Traits\WithActionButton;
    use Traits\WithButton;
    use Traits\WithCancelButton;
    use Traits\WithMessage;
    use Traits\WithTitle;
    use Traits\WithView;

    /**
     * Create a new modal alert instance.
     *
     * @return void
     */
    public function __construct(
        protected string $message
    ) {
        parent::__construct();
    }

    /**
     * Message store key for the modal alert.
     */
    public function key(): string
    {
        return 'modal';
    }

    /**
     * Convert the modal alert to an array.
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'type' => $this->key(),
            'level' => $this->getLevel(),
            'title' => $this->getTitle(),
            'message' => $this->getMessage(),
            'tag' => $this->getTag(),
            'size' => $this->getSize(),
            'scrollable' => $this->isScrollable(),
            'closable' => $this->isClosable(),
            'buttons' => $this->buttonsToArray(),
            'view' => $this->getView(),
        ]);
    }

    /**
     * Fill the modal alert from an array.
     *
     * @throws Exception
     * @throws Throwable
     */
    public static function fill(array $alert): AlertInterface
    {
        $modal = new static($alert['message']);

        $modal->id($alert['id']);
        $modal->size($alert['size']);
        $modal->level($alert['level']);
        $modal->scrollable($alert['scrollable'] ?? false);
        $modal->closable($alert['closable'] ?? false);
        $modal->buttons($alert['buttons'] ?? []);

        if (isset($alert['tag']) && $alert['tag']) {
            $modal->tag($alert['tag']);
        }

        if (isset($alert['title']) && $alert['title']) {
            $modal->title($alert['title']);
        }

        if (isset($alert['view']) && $alert['view']) {
            $modal->setView($alert['view']);
        }

        return $modal;
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
