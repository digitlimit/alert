<?php

namespace Digitlimit\Alert\Contracts;

interface Scrollable
{
    public function scrollable(): self;

    public function notScrollable(): self;

    public function isScrollable(): bool;
}
