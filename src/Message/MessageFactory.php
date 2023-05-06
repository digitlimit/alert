<?php

namespace Digitlimit\Alert\Message;

use Exception;
use Digitlimit\Alert\Helpers\TypeHelper;
use Digitlimit\Alert\Session;

class MessageFactory
{ 
    public static function make(Session $session, string $type, ...$args) : MessageInterface 
    {
        $class = TypeHelper::clasname($type);

        if(!class_exists($class)) {
            throw new Exception("Alert type '$class' class not found ");
        }

        return new $class($session, ...$args);
    }
}