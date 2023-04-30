<?php

namespace Digitlimit\Alert\Concerns;

interface WithClosable
{
    public function success() : self;

    public function info() : self;

    public function error() : self;

    public function warning() : self;
}