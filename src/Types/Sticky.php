<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Component\Button;
use Digitlimit\Alert\Helpers\Helper;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\SessionInterface;

class Sticky extends AbstractMessage implements MessageInterface
{
    /**
     * An instance of action button.
     */
    public Button $action;

    /**
     * Create a new sticky alert instance.
     *
     * @return void
     */
    public function __construct(
        protected SessionInterface $session,
        public ?string $message
    ) {
        $this->id($this->key().'-'.Helper::randomString());
        $this->action = new Button;
    }

    /**
     * Message store key for the sticky alert.
     */
    public function key(): string
    {
        return 'sticky';
    }

    /**
     * Set the action button.
     */
    public function action(string $label, ?string $link = null, array $attributes = []): self
    {
        $this->action = new Button($label, $link, $attributes);
        $this->flash();

        return $this;
    }

    /**
     * Put alert in the store.
     */
    public function flash(): void
    {
        $sessionKey = SessionKey::key($this->key(), $this->getTag());
        $this->session->put($sessionKey, $this);
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
        $this->session->forget($sessionKey);
    }
}
