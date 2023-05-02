<?php

namespace Digitlimit\Alert\Enums;

use Digitlimit\Alert\Traits\EnumFinders;
use Digitlimit\Alert\Traits\EnumValues;

enum Level: string
{
    use EnumValues;
    use EnumFinders;
    
    case SUCCESS = 'success';
    case INFO    = 'info';
    case ERROR   = 'error';
    case WARNING = 'warning';
}