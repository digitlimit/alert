<?php

namespace Digitlimit\Alert\Message;

interface MessageInterface
{
    /**
     * Set the alert ID
     */
    public function id(string|int $id) : self;
    
    /**
     * Set the alert message
     */
    public function message(string $message) : self;

    /**
     * Set the alert title
     */
    public function title(string $title) : self;

    /**
     * Set the alert level
     */
    public function level(string $level) : self;

    /**
     * Set the alert tag
     */
    public function tag(string $tag) : self;

    /**
     * Flash the alert to store
     */
    public function flash(string $message=null, string $level=null) : void;
}