<?php

namespace Digitlimit\Alert\Values;

class Button
{
   public function __construct(
      private string $label,
      private string $link     = '',
      private array $attributes= []
   ){
      $this->attributes = $attributes;
   }

   public function label() : string 
   {
      return $this->label;
   }

   public function link() : string 
   {
      return $this->link;
   }

   public function attributes() : array 
   {
      return $this->attributes;
   }
}