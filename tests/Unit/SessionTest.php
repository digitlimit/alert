<?php

use Digitlimit\Alert\Session;
use Digitlimit\Alert\SessionInterface;

it('can flash data to session', function () 
{
    // app()->make(SessionInterface::class);

    // $session = Mockery::spy(SessionInterface::class);
    // // $session = app(SessionInterface::class);
    // // $store   = Mockery::spy('Illuminate\Session\Store');
    // // $session = new Session($store);

    // $session
    //     ->flash('testing', ['test' => 'yes']);

    // $session
    //     ->get('testing');

    // $session
    //     ->shouldHaveReceived()
    //     ->flash('testing', ['test' => 'yes']);

    // $session
    //     ->shouldHaveReceived()
    //     ->get('testing')
    //     ->andReturn(['test' => 'yes']);
   
})->name('session', 'session-flash');
