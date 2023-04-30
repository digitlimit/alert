<?php

namespace Digitlimit\Alert;

use  Digitlimit\Alert\Enums\Level;

class AlertLevel
{
    protected Level $level;

    public function __construct()
    {
        $this->success();
    }

    public function type() : Level 
    {
        return $this->level;
    }

    public function success() : void
    {
        $this->level = Level::SUCCESS;
    }

    public function info() : void
    {
        $this->level = Level::INFO;
    }

    public function error() : void
    {
        $this->level = Level::ERROR;
    }

    public function warning() : void
    {
        $this->level = Level::WARNING;
    }
}