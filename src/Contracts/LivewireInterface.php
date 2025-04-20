<?php

namespace Digitlimit\Alert\Contracts;

interface LivewireInterface
{
    public function refresh(string $tag, array $alerts): void;
}
