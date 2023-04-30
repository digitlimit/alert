<?php

namespace Digitlimit\Alert\Concerns;

interface WithTypes
{
    public function bar() : self;

    public function field() : self;

    public function modal() : self;

    public function notify() : self;

    public function sticky() : self;
}