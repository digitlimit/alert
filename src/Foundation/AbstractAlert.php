<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Helpers\SessionKey;
use Illuminate\Support\Facades\Session;

/**
 * @property string $message
 */
abstract class AbstractMessage implements MessageInterface
{
    /**
     * Alert unique ID.
     * The ID is set automatically if not provided.
     */
    protected string|int $id;

    /**
     * Abstract alert key method should return alert key.
     */
    abstract public function key(): string;

    public function __construct() {
        $this->autoSetId();
    }

    /**
     * Set alert ID.
     */
    public function id(string|int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set alert ID to auto generate.
     */
    public function autoSetId(): self
    {
        $this->id($this->key().'-'.Helper::randomString());
        return $this;
    }

    /**
     * Fetch the alert ID.
     */
    public function getId(): string|int
    {
        return $this->id;
    }

    /**
     * Flash alert to store.
     * Its temporal store that is deleted once pulled/fetched.
     */
    public function flash(): void
    {
        $sessionKey = SessionKey::key($this->key(), $this->getTag());

        if (empty($sessionKey)) {
            return;
        }

        Session::flash($sessionKey, $this);
    }

    /**
     * Remove alert from the store.
     */
    public function forget(?string $tag = null): self
    {
        if(empty($tag)) {
            $tag = !empty($this->tag)
                ? $this->tag
                : Alert::DEFAULT_TAG;
        }

        $sessionKey = SessionKey::key($this->key(), $tag);

        Session::forget($sessionKey);

        return $this;
    }

    /**
     * Convert alert to array.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
        ];
    }
}
