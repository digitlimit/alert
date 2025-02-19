<?php

namespace Digitlimit\Alert\Helpers;

use Digitlimit\Alert\Contracts\ThemeInterface;
use Exception;

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

    /**
     * @throws Exception
     */
    public static function theme(): ThemeInterface
    {
        $name = self::name();
        $themes = self::all();

        $theme = $themes[$name] ?? null;

        if (!$theme) {
            throw new Exception("Theme {$name} not found");
        }

        return app($theme);
    }
}
