<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Session;
use Digitlimit\Alert\Component\Button;
use  Digitlimit\Alert\Helpers\Helper;

class Sticky extends AbstractMessage implements MessageInterface
{
    /**
     * An instance of action button
     */
    public Button $action;
    
    /**
     * Create a new sticky alert instance.
     * @return void
     */
    public function __construct(
        protected Session $session, 
        public ?string $message
    ) {
        $this->id(Helper::randomString());
        $this->action = new Button();
    }

    /**
     * Message store key for the sticky alert
     */
    public function key(): string
    {
        return 'sticky';
    }

    /**
     * Set the action button
     */
    public function action(string $label, string $link=null, array $attributes=[]) : self 
    {
        $this->action = new Button($label, $link, $attributes);
        return $this;
    }
}