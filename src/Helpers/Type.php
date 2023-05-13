<?php

namespace Digitlimit\Alert\Helpers;

use Exception;
use Digitlimit\Alert\ConfigInterface;

class Type
{    
    const PREFIX = 'alert-';

    public static function types() : array 
    {
        $config = app(ConfigInterface::class);
        
        return $config
            ->get('alert.types');
    }

    public static function prefixed(string $type) : string 
    {
        return self::PREFIX . $type;
    }

    public static function exists(string $type) : bool
    {
        $types = self::types();
        return isset($types[$type]) || isset($types[self::prefixed($type)]);
    }

    public static function type(string $type) : array
    {
        $types = self::types();
        return  $types[$type] ?? $types[self::prefixed($type)];
    }

    public static function clasname(string $type) : string
    {
        if(!self::exists($type)) {
            throw new Exception("The alert type '$type' does not exist in config");
        }
        
        return self::type($type)['alert'];
    }
}