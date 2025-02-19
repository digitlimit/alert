<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\SessionInterface;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Traits\Levelable;

/**
 * @property string $title
 * @property string $message
 * @property string $level
 */
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
        $this->flash();

        return $this;
    }

    /**
     * Set alert level.
     */
    public function level(string $level): self
    {
        $this->level = $level;
        $this->flash();

        return $this;
    }

    /**
     * Set alert message.
     */
    public function message(string $message): self
    {
        $this->message = $message;
        $this->flash();

        return $this;
    }

    /**
     * Set the alert title.
     */
    public function title(string $title): self
    {
        $this->title = $title;
        $this->flash();

        return $this;
    }

    /**
     * Set the alert tag.
     */
    public function tag(string $tag): self
    {
        $this->tag = $tag;
        $this->flash();

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
     * Fetch the alert level.
     */
    public function getLevel(): ?string
    {
        return $this->level ?? null;
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

        $this->session->flash($sessionKey, $this);
    }
}
