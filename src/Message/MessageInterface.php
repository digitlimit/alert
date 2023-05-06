<?php

namespace Digitlimit\Alert\Message;

use Digitlimit\Alert\Enums\Level;

interface MessageInterface
{
    public function message(string $message) : self;

    public function title(string $title) : self;

    public function level(string $level) : self;

    public function tag(string $tag) : self;

    public function flash(string $message='', string $level='') : void;
}