<?php

namespace Digitlimit\Alert\Contracts;

interface ThemeInterface
{
    /**
     * Alert types.
     */
    public function types(): array;

    /**
     * Boot the theme.
     */
    public function boot(): void;
}
