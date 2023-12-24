<?php

namespace Digitlimit\Alert;

use Illuminate\Config\Repository;

/**
 * Class Config
 * @package Digitlimit\Alert
 */
class Config implements ConfigInterface
{
    /**
     * The config.
     */
    private Repository $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Fetch value from the config based on the given key.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->config->get($key, $default);
    }
}
