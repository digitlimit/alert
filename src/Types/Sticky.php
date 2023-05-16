<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Session;
use Digitlimit\Alert\Component\Button;
use  Digitlimit\Alert\Helpers\Helper;

class Sticky extends AbstractMessage implements MessageInterface
{
    public Button $action;
    
    public function __construct(
        protected Session $session, 
        public ?string $message
    ) {
        $this->id(Helper::randomString());
        $this->action = new Button();
    }

    public function key(): string
    {
        return 'sticky';
    }

    public function action(string $label, string $link=null, array $attributes=[]) : self 
    {
        $this->action = new Button($label, $link, $attributes);
        return $this;
    }
}