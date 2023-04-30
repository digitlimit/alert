<?php

namespace Digitlimit\Alert\Traits;

trait TypesTrait
{
    public function bar() : self
    {
        $this->type->bar();
        $this->alerter->setType($this->type);
        return $this;
    }

    public function field() : self
    {
        $this->type->field();
        $this->alerter->setType($this->type);
        return $this;
    }

    public function modal() : self
    {
        $this->type->modal();
        $this->alerter->setType($this->type);
        return $this;
    }

    public function notify() : self
    {
        $this->type->notify();
        $this->alerter->setType($this->type);
        return $this;
    }

    public function sticky() : self
    {
        $this->type->sticky();
        $this->alerter->setType($this->type);
        return $this;
    }
}
