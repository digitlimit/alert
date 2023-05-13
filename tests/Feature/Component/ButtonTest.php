<?php

use Digitlimit\Alert\Component\Button;

it('can create button component', function () 
{
   $button = new Button('Submit', '/about', ['class' => 'btn-sm']);

   expect($button->label)->toEqual('Submit');
   expect($button->link)->toEqual('/about');
   expect($button->attributes)->toEqual(['class' => 'btn-sm']);

   $button->label('Register');
   $button->link('/register');
   $button->attributes(['id' => 'register']);

   expect($button->label)->toEqual('Register');
   expect($button->link)->toEqual('/register');
   expect($button->attributes)->toEqual(['id' => 'register']);
  
})->name('component', 'component-button');