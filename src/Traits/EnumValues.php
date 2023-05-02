<?php

namespace Digitlimit\Alert\Traits;

trait EnumValues
{
    /**
     * Return enum values
     */
    public static function values(): array
    {
      return array_column(self::cases(), 'value');
    }
}