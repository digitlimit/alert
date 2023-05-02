<?php

namespace Digitlimit\Alert\Helpers;

class SessionKey
{
    const MAIN_KEY = 'digitlimit.alert';

    public static function key(string $type, string $tag) : string 
    {
        return self::MAIN_KEY 
        . '.' . $type 
        . '.' . $tag;
    }
}