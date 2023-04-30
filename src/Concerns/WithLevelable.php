<?php

namespace Digitlimit\Alert\Concerns;

interface WithLevelable
{
    public function success() : self;

    public function info() : self;

    public function error();

    public function warning();
}