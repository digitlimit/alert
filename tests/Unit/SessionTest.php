<?php

use Digitlimit\Alert\Session;

it('can flash data to session', function () 
{
    $store   = Mockery::spy('Illuminate\Session\Store');
    $session = new Session($store);

    $session
        ->flash('testing', ['test' => 'yes']);

    $store
        ->shouldHaveReceived()
        ->flash('testing', ['test' => 'yes']);
   
})->name('session', 'session-flash');
