<?php

namespace Digitlimit\Alert\Helpers;

class Theme
{
    public static function name(): string
    {
        return Helper::config()->get('alert.theme');
    }

    public static function all(): array
    {
        return Helper::config()->get('alert.themes');
    }

    public static function theme(): array
    {
        $name = self::name();
        $themes = self::all();

        return $themes[$name] ?? [];
    }
}
