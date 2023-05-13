<?php

namespace Digitlimit\Alert;

use Illuminate\Config\Repository;

class Config implements ConfigInterface
{
    private Repository $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function get(string $key, mixed $default=null) : mixed
    {
        return $this->config->get($key, $default);
    }
}
