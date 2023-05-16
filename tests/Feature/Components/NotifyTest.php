<?php

use Digitlimit\Alert\Facades\Alert;

it('can render a default notify alert', function () 
{
    Alert::sticky('Thank you for joining us')
    ->flash();

    $this
    ->blade('<x-alert-notify />')
    ->assertSee('class="alert alert-"', false)
    ->assertSee('Thank you for joining us');
  
})->name('view-component', 'view-component-notify-default');