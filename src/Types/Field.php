<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Contracts\SessionInterface;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;

class Field extends AbstractMessage implements MessageInterface
{
    /**
     * Create a new field alert instance.
     *
     * @return void
     */
    public function __construct(
        protected SessionInterface $session,
        public string $name,
        public string $message
    ) {
        $this->id($this->key().'-'.Helper::randomString());
    }

    /**
     * Message store key for the field alert.
     */
    public function key(): string
    {
        return 'field';
    }

    /**
     * Get field store tag.
     */
    public function getTag(): string
    {
        if ($this->name) {
            //e.g default.firstname
            return $this->tag.'.'.$this->name;
        }

        return $this->tag;
    }

    /**
     * Flash field instance to store.
     */
    public function flash(): void
    {
        $sessionKey = SessionKey::key($this->key(), $this->getTag());

        if (empty($this->name) || empty($this->message)) {
            return;
        }

        $this->session->flash($sessionKey, $this);
    }
}
