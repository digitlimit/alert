<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Session;
use Exception;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;

class Field extends AbstractMessage implements MessageInterface
{
    /**
     * Field name.
     */
    public ?string $name = null;

    /**
     * Create a new field alert instance.
     *
     * @return void
     */
    public function __construct(
        protected Session $session,
        public ?string $message
    ) {
        $this->id(Helper::randomString());
    }

    /**
     * Message store key for the field alert.
     */
    public function key(): string
    {
        return 'field';
    }

    /**
     * Set field name.
     */
    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
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
    public function flash(string $message = null, string $level = null): void
    {
        $this->message = $message ?? $this->message;
        $this->level = $level ?? $this->level;

        if(empty($this->name)) {
            throw new Exception("Field name is required");
        }

        $sessionKey = SessionKey::key($this->key(), $this->getTag());
        $this->session->flash($sessionKey, $this);
    }
}
