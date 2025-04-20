<?php

namespace Digitlimit\Alert\Foundation;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Helpers\SessionKey;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Facades\Session;

/**
 * @property string $message
 */
abstract class AbstractAlert implements AlertInterface, Arrayable, Jsonable
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

    public function __construct()
    {
        $this->autoSetId();
    }

    /**
     * Set alert ID.
     */
    public function id(string|int $id): self
    {
        if (! empty($this->id) && $this->id !== $id) {
            $this->forget();
        }

        $this->id = $id;
        $this->flash();

        return $this;
    }

    /**
     * Set alert ID to auto generate.
     */
    public function autoSetId(): self
    {
        if (! empty($this->id)) {
            return $this;
        }

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
     * Fetch the alert tag.
     */
    public function getIdTag(): string
    {
        return $this->getTag().'.'.$this->getId();
    }

    /**
     * Flash alert to store.
     * Its temporal store that is deleted once pulled/fetched.
     */
    public function flash(): void
    {
        if (empty($this->id) || empty($this->message)) {
            return;
        }

        $sessionKey = SessionKey::key(
            $this->key(),
            $this->getIdTag()
        );

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
        $tag = $tag
            ? $tag.'.'.$this->getId()
            : $this->getIdTag();

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

    /**
     * Convert alert to json.
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray());
    }
}
