<?php

namespace Digitlimit\Alert;

use Digitlimit\Alert\Contracts\HasName;
use Digitlimit\Alert\Contracts\Taggable;
use Digitlimit\Alert\Factory\AlertFactory;
use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Helpers\Type;
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
     * Fetch an alert based on the type and named.
     *
     * @throws Exception
     */
    public static function named(string $type, string $name, string $tag): ?HasName
    {
        if (! Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        $tag = $tag.'.'.$name;

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
     * Fetch an alert from the given alert type.
     *
     * @throws Exception
     */
    public static function from(string $type, ...$args): AlertInterface
    {
        if (! Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        return AlertFactory::make($type, ...$args);
    }

    public static function forget(string $type, string $tag = Alert::DEFAULT_TAG): void
    {
        Session::forget(SessionKey::key($type, $tag));
    }

    /**
     * Fetch an alert based on the type and named.
     *
     * @throws Exception
     */
    public static function getField(string $name, string $tag = Alert::DEFAULT_TAG): ?HasName
    {
        return self::named('field', $name, $tag);
    }

    /**
     * Fetch an alert based on the type and named.
     *
     * @throws Exception
     */
    public static function getMessage(string $tag = Alert::DEFAULT_TAG): ?Taggable
    {
        return self::tagged('message', $tag);
    }

    /**
     * Fetch an alert based on the type and named.
     *
     * @throws Exception
     */
    public static function getModal(string $tag = Alert::DEFAULT_TAG): ?Taggable
    {
        return self::tagged('modal', $tag);
    }

    /**
     * Fetch an alert based on the type and named.
     *
     * @throws Exception
     */
    public static function getNotify(string $tag = Alert::DEFAULT_TAG): ?Taggable
    {
        return self::tagged('notify', $tag);
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $alert): ?AlertInterface
    {
        if (empty($alert)) {
            return null;
        }

        $type = $alert['type'] ?? null;

        if (! $type || ! Type::exists($type)) {
            throw new Exception("Invalid alert type '$type'. Check the alert config");
        }

        return AlertFactory::makeFromArray($alert);
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
            return AlertFactory::make($method, ...$parameters);
        }

        throw new Exception("Method '$method' not found in Alert class.");
    }
}
