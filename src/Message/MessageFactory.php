<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Helpers\Type;
use Exception;

class MessageFactory
{
    /**
     * Make a new alert instance.
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

    // make from array
    public static function makeFromArray(array $alert): MessageInterface
    {
        $type = $alert['type'];
        $class = Type::classname($type);

        if (! class_exists($class)) {
            throw new Exception("Alert type '$class' class not found ");
        }

        return app($class)->fill($alert);
    }
}
