<?php

namespace Digitlimit\Alert\Enums;

enum Level: string
{
    case SUCCESS = 'success';
    case INFO    = 'info';
    case ERROR   = 'error';
    case WARNING = 'warning';
}