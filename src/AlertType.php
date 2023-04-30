<?php

namespace Digitlimit\Alert;

use  Digitlimit\Alert\Enums\Type;

class AlertType
{
    protected Type $type;

    public function __construct()
    {
        $this->bar();
    }

    public function name() : Type 
    {
        return $this->type;
    }

    public function bar() : void
    {
        $this->type = Type::BAR;
    }

    public function field() : void
    {
        $this->type = Type::FIELD;
    }

    public function modal() : void
    {
        $this->type = Type::MODAL;
    }

    public function notify() : void
    {
        $this->type = Type::NOTIFY;
    }

    public function sticky() : void
    {
        $this->type = Type::STICKY;
    }
}