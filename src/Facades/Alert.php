<?php

namespace Digitlimit\Alert\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static named(string $string, string $string1)
 * @method static message(string $string)
 * @method static modal(string $string)
 * @method static notify(string $string)
 * @method static sticky(string $string)
 * @method static field(string $name, string $message)
 * @method static form(string $string, string $string1)
 * @method static success(string $string)
 * @method static error(string $string)
 * @method static warning(string $string)
 * @method static info(string $string)
 */
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
