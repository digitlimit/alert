<?php

namespace Digitlimit\Alert\Facades;

use Illuminate\Support\Facades\Facade;

class Alert extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'alert';
    }
}
