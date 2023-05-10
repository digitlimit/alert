<?php

namespace Digitlimit\Alert\Helpers;

class Attribute
{
    public static function toString(array $attributes) : string 
    {
        $newAttributes = array_map(function($key) use ($attributes) 
        {
            $key   = htmlspecialchars($key);
            $value = htmlspecialchars($attributes[$key]) ?? '';

            return "$key=\"$value\"";

        }, array_keys($attributes));

        return join(' ', $newAttributes);
    }
}