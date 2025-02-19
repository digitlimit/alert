<?php

namespace Digitlimit\Alert\Helpers;

use Digitlimit\Alert\Contracts\ConfigInterface;

class Helper
{
    /**
     * Generate a random string.
     */
    public static function randomString(int $length = 10): string
    {
        return substr(md5(mt_rand()), 0, $length);
    }

    public static function config(): ConfigInterface
    {
        return app(ConfigInterface::class);
    }
}
