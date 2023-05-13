<?php

namespace Digitlimit\Alert\Helpers;

use Exception;
use Digitlimit\Alert\ConfigInterface;

class TypeHelper
{    
    const PREFIX = 'alert-';

    public function __construct(
        protected ConfigInterface $config
    ){}

    public function types() : array 
    {
        return $this
            ->config
            ->get('alert.types');
    }

    public function prefixed(string $type) : string 
    {
        return self::PREFIX . $type;
    }

    public function exists(string $type) : bool
    {
        $types = $this->types();

        return isset($types[$type]) 
            || isset($types[$this->prefixed($type)]);
    }

    public function type(string $type) : array
    {
        $types = $this->types();

        return  $types[$type] 
            ?? $types[$this->prefixed($type)];
    }

    public function clasname(string $type) : string
    {
        if(!$this->exists($type)) {
            throw new Exception("The alert type '$type' does not exist in config");
        }
        
        return $this->type($type)['alert'];
    }
}