<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Contracts\HasMessage;
use Digitlimit\Alert\Contracts\HasName;
use Digitlimit\Alert\Contracts\HasTitle;
use Digitlimit\Alert\Contracts\Levelable;
use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Events\Field\Flashed;
use Digitlimit\Alert\Foundation\AbstractAlert;
use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Traits;
use Illuminate\Support\Facades\Session;

/**
 * Field alert class.
 */
class Field extends AbstractAlert implements AlertInterface, HasMessage, HasName, HasTitle, Levelable, Taggable
{
    use Traits\Levelable;
    use Traits\Taggable;
    use Traits\WithMessage;
    use Traits\WithName;
    use Traits\WithTitle;

    /**
     * The default level of the alert.
     */
    protected string $defaultLevel = 'error';

    /**
     * Create a new field alert instance.
     */
    public function __construct(
        protected string $name,
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
        return $this->tag;
    }

    /**
     * Get the named tag for the field alert.
     */
    public function getNamedTag(): string
    {
        return $this->tag.'.'.$this->getName();
    }

    /**
     * Get the field alert as an array.
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'type' => $this->key(),
            'name' => $this->getName(),
            'tag' => $this->getTag(),
            'named_tag' => $this->getNamedTag(),
            'level' => $this->getLevel(),
            'title' => $this->getTitle(),
            'message' => $this->getMessage(),
        ]);
    }

    /**
     * Fill the field alert from an array.
     */
    public static function fill(array $alert): AlertInterface
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

    /**
     * Flash field instance to store.
     */
    public function flash(): void
    {
        if (empty($this->name) || empty($this->message)) {
            return;
        }

        $sessionKey = SessionKey::key(
            $this->key(),
            $this->getNamedTag()
        );

        Session::flash($sessionKey, $this);
        Flashed::dispatch($this);
    }
}
