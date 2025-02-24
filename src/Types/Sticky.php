<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\HasButton;
use Digitlimit\Alert\Events\FieldBag\Flashed;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Message\MessageInterface;
use Illuminate\Support\Facades\Session;
use Digitlimit\Alert\Traits;

class Sticky extends Message implements HasButton
{
    use Traits\WithButton;
    use Traits\WithActionButton;

    /**
     * Message store key for the sticky alert.
     */
    public function key(): string
    {
        return 'sticky';
    }

    /**
     * Remove alert from the store.
     */
    public function forget(?string $tag = null): void
    {
        $tag = $tag ?? $this->getTag();

        if (empty($tag)) {
            $tag = Alert::DEFAULT_TAG;
        }

        $sessionKey = SessionKey::key($this->key(), $tag);

        Session::forget($sessionKey);
    }

    /**
     * Convert the alert to an array.
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'type' => $this->key(),
            'title' => $this->getTitle(),
            'message' => $this->getMessage(),
            'level' => $this->getLevel(),
            'tag' => $this->getTag(),
            'buttons' => $this->getButtons(),
        ]);
    }

    /**
     * Fill the sticky alert from an array.
     */
    public static function fill(array $alert): MessageInterface
    {
        $sticky = new static($alert['message']);
        $sticky->id($alert['id']);
        $sticky->level($alert['level']);
        $sticky->tag($alert['tag']);
        $sticky->buttons($alert['buttons'] ?? []);

        if ($alert['title']) {
            $sticky->title($alert['title']);
        }

        return $sticky;
    }

    /**
     * Put alert in the store.
     */
    public function flash(): void
    {
        $sessionKey = SessionKey::key($this->key(), $this->getTag());

        Session::put($sessionKey, $this);
        Flashed::dispatch($this);
    }
}
