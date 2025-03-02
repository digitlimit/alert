<?php

namespace Digitlimit\Alert\Helpers;

/**
 * Session key helper class.
 */
class SessionKey
{
    /**
     * Default alert store key.
     */
    const MAIN_KEY = 'digitlimit.alert';

    public static function mainKey(): string
    {
        return self::MAIN_KEY;
    }

    /**
     * Get a session key for a given type and tag.
     */
    public static function key(string $type, string $tag): string
    {
        return self::mainKey()
            .'.'.$type
            .'.'.$tag;
    }

    public static function typeKey(string $type): string
    {
        return self::mainKey()
            .'.'.$type;
    }
}
