<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Types\Notify;
use Digitlimit\Alert\Message\MessageInterface;

it('can create a notify alert', function () 
{
    Alert::notify('Thank you!')->flash();

    $default = Alert::default('notify');

    expect($default)->toBeInstanceOf(MessageInterface::class);
    expect($default)->toBeInstanceOf(Notify::class);
    expect($default->message)->toEqual('Thank you!');

})->name('types', 'types-notify', 'types-notify');
