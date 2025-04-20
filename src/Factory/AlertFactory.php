<?php

namespace Digitlimit\Alert\Factory;

use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Helpers\Type;
use Exception;

/**
 * Alert message factory.
 */
class AlertFactory
{
    /**
     * Make a new alert instance.
     *
     * @throws Exception
     */
    public static function make(string $type, ...$args): AlertInterface
    {
        $class = Type::classname($type);

        if (!class_exists($class)) {
            throw new Exception("Alert type '$class' class not found ");
        }

        return new $class(...$args);
    }

    /**
     * Make a new alert instance from an array.
     *
     * @throws Exception
     */
    public static function makeFromArray(array $alert): AlertInterface
    {
        $type = $alert['type'];
        $class = Type::classname($type);

        if (!class_exists($class)) {
            throw new Exception("Alert type '$class' class not found ");
        }

        return app($class, $alert)->fill($alert);
    }
}
