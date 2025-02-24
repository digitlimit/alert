<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Contracts\Levelable;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Illuminate\Support\Facades\Session;
use Digitlimit\Alert\Events\Field\Flashed;
use Digitlimit\Alert\Traits;

class Field extends AbstractMessage implements MessageInterface, Levelable
{
    use Traits\Levelable;

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
            'name' => $this->name,
            'message' => $this->message,
            'tag' => $this->getTag(),
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

        return $field;
    }
}
