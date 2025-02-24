<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Contracts\Levelable;
use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Illuminate\Support\Facades\Session;
use Digitlimit\Alert\Events\Field\Flashed;
use Digitlimit\Alert\Traits;

class Field extends AbstractMessage implements MessageInterface, Levelable, Taggable
{
    use Traits\Levelable;
    use Traits\Taggable;

    /**
     * Create a new field alert instance.
     *
     * @return void
     */
    public function __construct(
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
     * Set the field name.
     */
    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the field message.
     */
    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the field name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the field message.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Get field store tag.
     */
    public function getTag(): string
    {
        if ($this->getName()) {
            //e.g default.firstname
            return $this->getTag().'.'.$this->getName();
        }

        return $this->getTag();
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

        Session::flash($sessionKey, $this);
        Flashed::dispatch($this);
    }

    /**
     * Get the field alert as an array.
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'type' => $this->key(),
            'tag' => $this->getTag(),
            'level' => $this->getLevel(),
            'name' => $this->getName(),
            'message' => $this->getMessage(),
        ]);
    }

    /**
     * Fill the field alert from an array.
     */
    public static function fill(array $alert): MessageInterface
    {
        $field = new static($alert['name'], $alert['message']);

        $field->id($alert['id']);
        $field->tag($alert['tag']);
        $field->level($alert['level']);

        return $field;
    }
}
