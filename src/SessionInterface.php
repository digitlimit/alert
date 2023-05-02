<?php

namespace Digitlimit\Alert;

interface SessionInterface
{
    public function flash(string $name, mixed $value) : void;

    public function get(string $key, mixed $default=null) : mixed;
}
