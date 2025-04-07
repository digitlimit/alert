<?php

namespace Digitlimit\Alert\Tests\Fixtures;

use Digitlimit\Alert\Contracts\Closable as ClosableContract;
use Digitlimit\Alert\Traits\Closable;

class DummyClosableClass implements ClosableContract
{
    use Closable;
}