<?php

namespace Digitlimit\Alert\Contracts;

interface Levelable
{
    public function success(): self;

    public function info(): self;

    public function warning(): self;

    public function error(): self;

    public function level(string $level): self;

    public function getLevel(): string;
}
