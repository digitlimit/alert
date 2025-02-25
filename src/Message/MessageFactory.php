<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Helpers\Type;
use Digitlimit\Alert\SessionInterface;
use Exception;

class MessageFactory
{
    /**
     * Make a new alert instance.
     */
    public static function make(SessionInterface $session, string $type, ...$args): MessageInterface
    {
        $class = Type::classname($type);

        if (!class_exists($class)) {
            throw new Exception("Alert type '$class' class not found ");
        }

        return new $class($session, ...$args);
    }
}
