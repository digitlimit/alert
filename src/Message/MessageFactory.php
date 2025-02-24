<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Helpers\Type;
use Exception;
use ReflectionClass;

/**
 * Alert message factory.
 */
class MessageFactory
{
    /**
     * Make a new alert instance.
     *
     * @throws Exception
     */
    public static function make(string $type, ...$args): MessageInterface
    {
        $class = Type::classname($type);

        if (! class_exists($class)) {
            throw new Exception("Alert type '$class' class not found ");
        }

        return new $class(...$args);
    }

    /**
     * Make a new alert instance from an array.
     *
     * @throws Exception
     */
    public static function makeFromArray(array $alert): MessageInterface
    {
        $type = $alert['type'];
        $class = Type::classname($type);

        if (! class_exists($class)) {
            throw new Exception("Alert type '$class' class not found ");
        }

        return app($class, $alert)->fill($alert);
    }
}
