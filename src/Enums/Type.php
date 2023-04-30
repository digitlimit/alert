<?php

namespace Digitlimit\Alert\Enums;

enum Type: string
{
    case BAR    = 'bar';
    case FIELD  = 'field';
    case MODAL  = 'modal';
    case NOTIFY = 'notify';
    case STICKY = 'sticky';
}