<?php

namespace Digitlimit\Alert\Component;

class Button
{
   public function __construct(
      public string $label      = '',
      public string $link       = '',
      public array  $attributes = []
   ){}

   public function label(string $label) : void 
   {
      $this->label = $label;
   }

   public function link(string $link) : void 
   {
      $this->link = $link;
   }

   public function attributes(array $attributes) : void 
   {
      $this->attributes = $attributes;
   }
}