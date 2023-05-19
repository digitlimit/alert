<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Types\Notify;

it('can create a notify alert', function () {
    Alert::notify('Thank you!')->flash();

    $default = Alert::default('notify');

    expect($default)->toBeInstanceOf(MessageInterface::class);
    expect($default)->toBeInstanceOf(Notify::class);
    expect($default->message)->toEqual('Thank you!');
})->name('types', 'types-notify', 'types-notify');
