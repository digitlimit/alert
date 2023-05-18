<?php

namespace Digitlimit\Alert\Message;

use Exception;
use Digitlimit\Alert\Helpers\Type;
use Digitlimit\Alert\Session;

class MessageFactory
{ 
    /**
     * Make a new alert instance
     */
    public static function make(Session $session, string $type, ...$args) : MessageInterface 
    {
        $class = Type::clasname($type);

        if(!class_exists($class)) {
            throw new Exception("Alert type '$class' class not found ");
        }

        return new $class($session, ...$args);
    }
}