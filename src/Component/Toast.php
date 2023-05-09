<?php

namespace Digitlimit\Alert\Component;

class Toast
{
   public string $position   = '';

   public function position(string $position) : void 
   {
      $this->position = $position;
   }
}