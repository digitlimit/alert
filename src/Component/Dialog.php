<?php

namespace Digitlimit\Alert\Component;

class Dialog
{
   public string $size       = '';
   public string $scrollable = '';
   public string $position   = '';

   public function size(string $size) : void 
   {
      $this->size = $size;
   }

   public function scrollable(string $scrollable) : void 
   {
      $this->scrollable = $scrollable;
   }

   public function position(string $position) : void 
   {
      $this->position = $position;
   }
}