<?php

use Digitlimit\Alert\Facades\Alert;

it('can render a default normal alert', function () 
{
    Alert::normal('Thank you for joining us')
    ->flash();

    $this
    ->blade('<x-alert-normal />')
    ->assertSee('class="alert alert-dismissible alert-"', false)
    ->assertSee('Thank you for joining us');
  
})->name('view-component', 'view-component-normal-default');