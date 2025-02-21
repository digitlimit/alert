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
use Illuminate\Support\Facades\Session;

class Alert
{
    use Macroable;

    /**
     * The name of the default type tag.
     */
    const DEFAULT_TAG = 'default';

    /**
     * Fetch an alert based on the default tag.
     */
    public function default(string $type): ?MessageInterface
    {
        return self::tagged($type, self::DEFAULT_TAG);
    }

    /**
     * Fetch an alert based on the type and named.
     */
    public function named(string $type, string $name, ?string $tag = null): ?MessageInterface
    {
        if (! Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        $tag = ($tag ?? self::DEFAULT_TAG).'.'.$name;

        return Session::get(
            SessionKey::key($type, $tag)
        );
    }

    /**
     * Fetch an alert based on the tag name.
     */
    public function tagged(string $type, string $tag): ?MessageInterface
    {
        if (! Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        $tagged = Session::get(
            SessionKey::key($type, $tag)
        );

        if (is_array($tagged)) {
            return null;
        }

        return $tagged;
    }

    /**
     * Fetch an alert from the given alert type.
     */
    public function from(string $type, ...$args): MessageInterface
    {
        if (! Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        return MessageFactory::make($type, ...$args);
    }

    /**
     * @throws Exception
     */
    public function fromArray(array $alert): MessageInterface
    {
        $type = $alert['type'] ?? null;

        if (!$type || !Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        return MessageFactory::makeFromArray($alert);
    }

    /**
     * Dynamically handle method calls for different alert types.
     * @throws Exception
     */
    public function __call($method, $parameters)
    {
        if (Type::exists($method)) {
            return MessageFactory::make($method, ...$parameters);
        }

        throw new Exception("Method '$method' not found in Alert class.");
    }

    /**
     * Fetch all alerts from the session.
     */
    public static function has(string $type): bool
    {
        $types = Session::get(SessionKey::typeKey($type)) ?? [];

        return ! empty($types);
    }

    /**
     * Fetch all alerts from the session.
     */
    public static function count(string $type): int
    {
        $types = Session::get(SessionKey::typeKey($type)) ?? [];

        return count($types);
    }

    /**
     * Fetch all alerts from the session.
     */
    public static function all(): array
    {
        return Session::get(SessionKey::mainKey()) ?? [];
    }
}
