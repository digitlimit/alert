<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Session;
use Digitlimit\Alert\Values\Button;

class Modal extends AbstractMessage implements MessageInterface
{
    public ?Button $action = null;
    public ?Button $cancel = null;

    public function __construct(
        protected Session $session, 
        public string $message
    ){}
    
    public function name(): string
    {
        return 'modal';
    }

    public function action(string $label, string $link='', array $attributes=[]) : self 
    {
        $this->action = new Button($label, $link, $attributes);
        return $this;
    }

    public function cancel(string $label, string $link='', array $attributes=[]) : self 
    {
        $this->cancel = new Button($label, $link, $attributes);
        return $this;
    }
}