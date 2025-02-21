<?php

namespace Digitlimit\Alert\Helpers;

use Exception;

class Type
{
    /**
     * Alert type prefix.
     */
    const PREFIX = 'alert-';

    /**
     * Fetch alert types from the config file.
     * @throws Exception
     */
    public static function types(): array
    {
        return Theme::theme()->types();
    }

    /**
     * Get the prefixed type for an alert type.
     */
    public static function prefixed(string $type): string
    {
        return self::PREFIX.$type;
    }

    /**
     * Check if an alert type exists.
     */
    public static function exists(string $type): bool
    {
        $types = self::types();

        return isset($types[$type]) || isset($types[self::prefixed($type)]);
    }

    /**
     * Get an alert type.
     */
    public static function type(string $type): array
    {
        $types = self::types();

        return $types[$type] ?? $types[self::prefixed($type)];
    }

    /**
     * Get alert class name.
     */
    public static function classname(string $type): string
    {
        if (! self::exists($type)) {
            throw new Exception("The alert type '$type' does not exist in config");
        }

        return self::type($type)['alert'];
    }
}
