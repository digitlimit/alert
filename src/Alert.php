<?php

namespace Digitlimit\Alert;

use Digitlimit\Alert\AlertLevel;
use Digitlimit\Alert\Concerns\WithLevelable;

class Alert implements WithLevelable
{
    protected Alerter $alerter;

    protected AlertLevel $level;

    public function __construct(Alerter $alerter)
    {
        $this->level   = new AlertLevel();
        
        $this->alerter = $alerter;
        $this->alerter->setLevel($this->level);
    }

    public function tag(string $tag) : self
    {
        $this->alerter->setTag($tag);
        return $this;
    }

    public function message(string $content, string $title='') : self
    {
        $message = new Message($content, $title);
        $this->alerter->setMessage($message);
        return $this;
    }

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

    public function alerter() : Alerter
    {
        return $this->alerter;
    }
}
