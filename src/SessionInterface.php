<?php

namespace Digitlimit\Alert;

interface SessionInterface
{
    public function flash(string $name, mixed $value) : void;
}
