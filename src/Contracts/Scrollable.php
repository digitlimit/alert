<?php

namespace Digitlimit\Alert\Contracts;

/**
 * The alert-scrollable contract.
 */
interface Scrollable
{
    public function scrollable(): self;

    public function notScrollable(): self;

    public function isScrollable(): bool;
}
