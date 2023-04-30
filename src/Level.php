<?php

namespace Digitlimit\Alert;

use  Digitlimit\Alert\Enums\LevelType;

class Level
{
    protected LevelType $levelType;

    public function __construct()
    {
        $this->success();
    }

    public function type() : LevelType 
    {
        return $this->levelType;
    }

    public function success() : void
    {
        $this->levelType = LevelType::SUCCESS;
    }

    public function info() : void
    {
        $this->levelType = LevelType::INFO;
    }

    public function error() : void
    {
        $this->levelType = LevelType::ERROR;
    }

    public function warning() : void
    {
        $this->levelType = LevelType::WARNING;
    }
}