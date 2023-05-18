<?php

namespace Digitlimit\Alert;

interface SessionInterface
{
    /**
     * Flash alert to store
     */
    public function flash(string $name, mixed $value) : void;

    /**
     * Fetch alert from the store
     */
    public function get(string $key, mixed $default=null) : mixed;
}
