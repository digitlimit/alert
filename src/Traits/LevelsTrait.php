<?php

namespace Digitlimit\Alert\Traits;

trait LevelsTrait
{
    public function success() : self
    {
        $this->level->success();
        $this->alerter->setLevel($this->level);
        return $this;
    }

    public function info() : self
    {
        $this->level->info();
        $this->alerter->setLevel($this->level);
        return $this;
    }

    public function error() : self
    {
        $this->level->error();
        $this->alerter->setLevel($this->level);
        return $this;
    }

    public function warning() : self
    {
        $this->level->warning();
        $this->alerter->setLevel($this->level);
        return $this;
    }
}
