<?php

namespace Digitlimit\Alert\Contracts;

interface ThemeInterface
{
    public function types(): array;

    public function boot(): void;
}
