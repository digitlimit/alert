<?php

namespace Digitlimit\Alert\Helpers;

class SessionKey
{
    /**
     * Default alert store key.
     */
    const MAIN_KEY = 'digitlimit.alert';

    /**
     * Get session key for a given type and tag.
     */
    public static function key(string $type, string $tag): string
    {
        return self::MAIN_KEY
        .'.'.$type
        .'.'.$tag;
    }
}
