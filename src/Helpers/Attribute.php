<?php

namespace Digitlimit\Alert\Helpers;

class Attribute
{
    /**
     * Convert an attribute array to HTML string attributes.
     */
    public static function toString(array $attributes): string
    {
        $newAttributes = array_map(function ($key) use ($attributes) {
            $key = htmlspecialchars($key);
            $value = htmlspecialchars($attributes[$key]) ?? '';

            return "$key=\"$value\"";
        }, array_keys($attributes));

        return implode(' ', $newAttributes);
    }
}
