<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Enums\Level;
use Digitlimit\Alert\Helpers\TypeHelper;
use Exception;

class MessageFactory
{
    public static function make(
        string $message,
        Level  $level,
        string $type,
        string $title=''
    ) : MessageInterface {

        $class = TypeHelper::clasname($type);

        if(!class_exists($class)) {
            throw new Exception("Alert type '$class' class not found ");
        }

        $alert = new $class($message);

        $alert
            ->setLevel($level)
            ->setTitle($title);

        return $alert;
    }
}