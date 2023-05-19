<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Helpers\Type;
use Digitlimit\Alert\Session;
use Exception;

class MessageFactory
{
    /**
     * Make a new alert instance.
     */
    public static function make(Session $session, string $type, ...$args): MessageInterface
    {
        $class = Type::clasname($type);
if($type == 'alert-bag') {
    dd($class);
}
        if (!class_exists($class)) {
            throw new Exception("Alert type '$class' class not found ");
        }

        return new $class($session, ...$args);
    }
}
