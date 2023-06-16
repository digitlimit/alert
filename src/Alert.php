<?php

namespace Digitlimit\Alert;

use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Helpers\Type;
use Digitlimit\Alert\Message\MessageFactory;
use Digitlimit\Alert\Message\MessageInterface;
use Exception;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Validation\Validator;

class Alert
{
    use Macroable;

    /**
     * The name of the default type tag.
     */
    const DEFAULT_TAG = 'default';

    /**
     * Create a new alert instance.
     *
     * @return void
     */
    public function __construct(
        protected SessionInterface $session
    ) {
    }

    /**
     * Fetch an alert based on the default tag.
     */
    public function default(string $type): MessageInterface|null
    {
        return self::tagged($type, self::DEFAULT_TAG);
    }

    /**
     * Fetch an alert based on the type and named.
     */
    public function named(
        string $type,
        string $name,
        string $tag = null
    ): MessageInterface|null {
        if (!Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        $tag = ($tag ?? self::DEFAULT_TAG).'.'.$name;

        return $this->session->get(
            SessionKey::key($type, $tag)
        );
    }

    /**
     * Fetch an alert based on the tag name.
     */
    public function tagged(
        string $type,
        string $tag
    ): MessageInterface|null {
        if (!Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        $tagged = $this->session->get(
            SessionKey::key($type, $tag)
        );

        if (is_array($tagged)) {
            return null;
        }

        return $tagged;
    }

    /**
     * Fetch the field alert.
     */
    public function field(string $message = null): MessageInterface
    {
        return MessageFactory::make(
            $this->session,
            'field',
            $message
        );
    }

    /**
     * Fetch the field bag alert.
     */
    public function fieldBag(
        Validator|MessageBag $bag = null
    ): MessageInterface {
        return MessageFactory::make(
            $this->session,
            'bag',
            $bag
        );
    }

    /**
     * Fetch the modal alert.
     */
    public function modal(string $message = null): MessageInterface
    {
        return MessageFactory::make($this->session, 'modal', $message);
    }

    /**
     * Fetch the notify alert.
     */
    public function notify(string $message = null): MessageInterface
    {
        return MessageFactory::make($this->session, 'notify', $message);
    }

    /**
     * Fetch the sticky alert.
     */
    public function sticky(string $message = null): MessageInterface
    {
        return MessageFactory::make($this->session, 'sticky', $message);
    }

    /**
     * Fetch the default alert type, which is the message alert.
     */
    public function message(string $message): MessageInterface
    {
        return MessageFactory::make($this->session, 'message', $message);
    }

    /**
     * Fetch an alert from the given alert type.
     */
    public function from(
        string $type,
        ...$args
    ): MessageInterface {
        if (!Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        return MessageFactory::make($this->session, $type, ...$args);
    }
}
