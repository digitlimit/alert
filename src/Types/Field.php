<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Contracts\HasMessage;
use Digitlimit\Alert\Contracts\HasTitle;
use Digitlimit\Alert\Contracts\Levelable;
use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Events\Field\Flashed;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Traits;
use Illuminate\Support\Facades\Session;

class Field extends AbstractMessage implements Levelable, MessageInterface, Taggable, HasTitle, HasMessage
{
    use Traits\Levelable;
    use Traits\Taggable;
    use Traits\WithTitle;
    use Traits\WithMessage;

    /**
     * Create a new field alert instance.
     *
     * @param string $name
     * @param string $message
     */
    public function __construct(
        public string $name,
        protected string $message
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
     * Get the field name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get field store tag.
     */
    public function getTag(): string
    {
        if ($this->getName()) {
            //e.g default.firstname
            return $this->tag.'.'.$this->getName();
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
            'title' => $this->getTitle(),
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

        if ($alert['title']) {
            $field->title($alert['title']);
        }

        return $field;
    }
}
