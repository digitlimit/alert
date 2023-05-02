<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Enums\Level;

interface MessageInterface
{
    public function setMessage(string $message) : self;

    public function setTitle(string $title) : self;

    public function setLevel(Level $level) : self;

    public function message() : string;

    public function title() : string;
}