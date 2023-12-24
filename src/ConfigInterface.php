<?php

namespace Digitlimit\Alert;

/**
 * Interface ConfigInterface
 */
interface ConfigInterface
{
    /**
     *  Fetch value from the config based on the given key.
     */
    public function get(string $key, ?string $default = null): mixed;
}
