<?php

namespace Digitlimit\Alert\Types;

use Digitlimit\Alert\Message\AbstractMessage;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Session;
use Digitlimit\Alert\Component\Button;
use Illuminate\View\View;

class Modal extends AbstractMessage implements MessageInterface
{
    public Button $action;
    public Button $cancel;

    public string $size       = '';
    public string $scrollable = '';
    public string $position   = '';
    public string $view       = '';

    public function __construct(
        protected Session $session, 
        public string $message
    ){
        $this->action = new Button();
        $this->cancel = new Button();
    }
    
    public function key(): string
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

    public function scrollable(
        string $class='modal-dialog-scrollable'
    ) : self {
        $this->scrollable = $class;
        return $this;
    }

    public function small(string $class='modal-sm') : self 
    {
        $this->size = $class;
        return $this;
    }

    public function large(string $class='modal-lg') : self 
    {
        $this->size = $class;
        return $this;
    }

    public function extraLarge(string $class='modal-xl') : self 
    {
        $this->size = $class;
        return $this;
    }

    public function fullscreen(string $class='modal-fullscreen') : self 
    {
        $this->size = $class;
        return $this;
    }

    public function centered(string $class='modal-dialog-centered') : self 
    {
        $this->position = $class;
        return $this;
    }

    public function view(View $view) : self 
    {
        $this->view = $view->render();
        return $this;
    }
}