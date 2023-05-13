<?php

namespace Digitlimit\Alert;

interface ConfigInterface
{
    public function get(string $key, string $default='') : mixed;
}