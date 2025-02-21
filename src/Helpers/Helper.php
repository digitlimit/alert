<?php

namespace Digitlimit\Alert\Helpers;

class Helper
{
    /**
     * Generate a random string.
     */
    public static function randomString(int $length = 10): string
    {
        return substr(md5(mt_rand()), 0, $length);
    }
}
