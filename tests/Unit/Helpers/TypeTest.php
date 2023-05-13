<?php

use Digitlimit\Alert\Helpers\Type;

it('can get types from the config file', function () 
{
 


//    expect(config('alert.types'))->toEqual($types);
   
})->name('helpers', 'helpers-type-helper-types');

// use Exception;

// class Type
// {
//     const PREFIX = 'alert-';

//     public static function types() : array 
//     {
//         return config('alert.types');
//     }

//     public static function prefixed(string $type) : string 
//     {
//         return self::PREFIX . $type;
//     }

//     public static function exists(string $type) : bool
//     {
//         $types = self::types();
//         return isset($types[$type]) || isset($types[self::prefixed($type)]);
//     }

//     public static function type(string $type) : array
//     {
//         $types = self::types();
//         return  $types[$type] ?? $types[self::prefixed($type)];
//     }

//     public static function clasname(string $type) : string
//     {
//         if(!self::exists($type)) {
//             throw new Exception("The alert type '$type' does not exist in config");
//         }
        
//         return self::type($type)['alert'];
//     }
// }