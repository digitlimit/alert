<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Message\LevelInterface;

class Modal extends AbstractMessage implements MessageInterface, LevelInterface
{
    public function name(): string
    {
        return 'modal';
    }
}