<?php

namespace Digitlimit\Alert\Traits;

trait Levelable
{
    public function primary() : self
    {
       $this->level = 'primary';
       return $this;
    }

    public function secondary() : self
    {
       $this->level = 'secondary';
       return $this;
    }

    public function success() : self
    {
       $this->level = 'success';
       return $this;
    }

    public function info() : self
    {
       $this->level = 'info';
       return $this;
    }

    public function error() : self
    {
       $this->level = 'danger';
       return $this;
    }

    public function warning() : self
    {
       $this->level = 'warning';
       return $this;
    }

    public function light() : self
    {
       $this->level = 'light';
       return $this;
    }

    public function dark() : self
    {
       $this->level = 'dark';
       return $this;
    }
}