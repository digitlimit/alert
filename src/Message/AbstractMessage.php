<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\SessionInterface;
use Digitlimit\Alert\Traits\Levelable;

abstract class AbstractMessage implements MessageInterface
{
    /**
     * Import the alert levels from trait.
     */
    use Levelable;

    /**
     * Alert store.
     */
    protected SessionInterface $session;

    /**
     * Alert unique ID.
     */
    public string|int $id;

    /**
     * Alert message.
     */
    public ?string $message = null;

    /**
     * Alert title.
     */
    public ?string $title = null;

    /**
     * Alert level.
     */
    public ?string $level = null;

    /**
     * Alert tag.
     */
    protected string $tag = Alert::DEFAULT_TAG;

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
     * Set alert level.
     */
    public function level(string $level): self
    {
        $this->level = $level;

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
     * Set the alert tag.
     */
    public function tag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Fetch the alert tag.
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * Flash alert to store.
     * Its a temporal store that is deleted once pulled/fetched.
     */
    public function flash(?string $message = null, ?string $level = null): void
    {
        $this->message = $message ?? $this->message;
        $this->level = $level ?? $this->level;

        $sessionKey = SessionKey::key($this->key(), $this->getTag());
        $this->session->flash($sessionKey, $this);
    }
}
