<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Helpers\SessionKey;
use Illuminate\Support\Facades\Session;

/**
 * @property string $title
 * @property string $message
 * @property string $level
 */
abstract class AbstractMessage implements MessageInterface
{
    /**
     * Alert unique ID.
     */
    public string|int $id;

    /**
     * Abstract alert key method should return alert key.
     */
    abstract public function key(): string;

    /**
     * Set alert ID.
     */
    public function id(string|int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set alert message.
     */
    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the alert title.
     */
    public function title(string $title): self
    {
        $this->title = $title;

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
     * Fetch the alert title.
     */
    public function getTitle(): ?string
    {
        return $this->title ?? null;
    }

    /**
     * Fetch the alert message.
     */
    public function getMessage(): ?string
    {
        return $this->message ?? null;
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
     * Convert alert to array.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'message' => $this->getMessage(),
        ];
    }
}
