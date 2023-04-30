<?php

namespace Digitlimit\Alert\Enums;

enum LevelType: string
{
    case SUCCESS = 'success';
    case INFO    = 'info';
    case ERROR   = 'error';
    case WARNING = 'warning';
}