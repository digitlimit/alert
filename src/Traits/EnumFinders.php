<?php

namespace Digitlimit\Alert\Traits;

trait EnumFinders
{
    public static function fromValue($value)
    {
        foreach(static::cases() as $case){
            if($case->value == $value) return $case;
        }
    }

    public static function fromName($name)
    {
        foreach(static::cases() as $case){
            if(strtolower($case->name) == strtolower($name)) return $case;
        }
    }

    public static function fromEnumName($enum)
    {
        foreach(static::cases() as $case){
            if($case->name == $enum->name) return $case;
        }
    }

    public static function fromEnumValue($enum)
    {
        foreach(static::cases() as $case){
            if($case->value == $enum->value) return $case;
        }
    }

    public static function valueIs($value, $case)
    {
        return self::fromValue($value) == $case;
    }
}