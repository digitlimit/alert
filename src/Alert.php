<?php

namespace Digitlimit\Alert;

use Digitlimit\Alert\AlertLevel;
use Digitlimit\Alert\AlertType;

use Digitlimit\Alert\Concerns\WithLevels;
use Digitlimit\Alert\Concerns\WithTypes;

use Digitlimit\Alert\Traits\LevelsTrait;
use Digitlimit\Alert\Traits\TypesTrait;

class Alert implements WithLevels, WithTypes
{
    use LevelsTrait, TypesTrait;

    protected Alerter $alerter;

    protected AlertLevel $level;

    protected AlertType $type;

    public function __construct(Alerter $alerter)
    {
        $this->level   = new AlertLevel();
        $this->type    = new AlertType();
        $this->alerter = $alerter;

        $this->alerter->setLevel($this->level);
        $this->alerter->setType($this->type);
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

    public function view(string $name, array $data=[]) : self
    {
        //@todo
        return $this;
    }

    public function alerter() : Alerter
    {
        return $this->alerter;
    }
}
