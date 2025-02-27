<?php

namespace Digitlimit\Alert;

use Digitlimit\Alert\Contracts\HasName;
use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Helpers\Type;
use Digitlimit\Alert\Message\MessageFactory;
use Digitlimit\Alert\Message\MessageInterface;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Traits\Macroable;

class Alert
{
    use Macroable;

    /**
     * The name of the default type tag.
     */
    const DEFAULT_TAG = 'default';

    /**
     * Fetch an alert based on the default tag.
     *
     * @throws Exception
     */
    public function default(string $type): ?Taggable
    {
        return self::tagged($type, self::DEFAULT_TAG);
    }

    /**
     * Fetch an alert based on the type and named.
     * @throws Exception
     */
    public static function named(string $type, string $name, string $tag): ?HasName
    {
        if (! Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        $tag = $tag . '.' . $name;

        return Session::get(
            SessionKey::key($type, $tag)
        );
    }

    /**
     * Fetch an alert based on the tag name.
     *
     * @throws Exception
     */
    public static function tagged(string $type, string $tag): ?Taggable
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
     * @throws Exception
     */
    public static function taggedField(string $tag): ?Taggable
    {
        return self::tagged('field', $tag);
    }

    /**
     * @throws Exception
     */
    public static function namedField(string $name, string $tag): ?MessageInterface
    {
        return self::named('field', $name, $tag);
    }

    /**
     * @throws Exception
     */
    public static function fieldBag(string $tag): ?Taggable
    {
        return self::tagged('bag', $tag);
    }

    /**
     * @throws Exception
     */
    public static function taggedMessage(string $tag): ?Taggable
    {
        return self::tagged('message', $tag);
    }

    /**
     * @throws Exception
     */
    public static function taggedModal(string $tag): ?Taggable
    {
        return self::tagged('modal', $tag);
    }

    /**
     * @throws Exception
     */
    public static function taggedNotify(string $tag): ?Taggable
    {
        return self::tagged('notify', $tag);
    }

    /**
     * Fetch an alert from the given alert type.
     *
     * @throws Exception
     */
    public static function from(string $type, ...$args): MessageInterface
    {
        if (! Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        return MessageFactory::make($type, ...$args);
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $alert): MessageInterface
    {
        $type = $alert['type'] ?? null;

        if (! $type || ! Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        return MessageFactory::makeFromArray($alert);
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
    public static function count(?string $type = null): int
    {
        $types = self::all($type);

        if ($type) {
            return count($types);
        }

        $count = 0;
        foreach ($types as $type) {
            $count += count($type);
        }

        return $count;
    }

    /**
     * Fetch all alerts from the session.
     */
    public static function all(?string $type = null): array
    {
        return $type
            ? Session::get(SessionKey::typeKey($type), [])
            : Session::get(SessionKey::mainKey(), []);
    }

    /**
     * Dynamically handle method calls for different alert types.
     *
     * @throws Exception
     */
    public function __call($method, $parameters)
    {
        if (Type::exists($method)) {
            return MessageFactory::make($method, ...$parameters);
        }

        throw new Exception("Method '$method' not found in Alert class.");
    }
}
