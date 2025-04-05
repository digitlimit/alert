<?php

namespace Digitlimit\Alert\Contracts;

use Illuminate\Support\Collection;

interface LivewireInterface
{
    public function refresh(string $tag, array $alerts): void;
}
