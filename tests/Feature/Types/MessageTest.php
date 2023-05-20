<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Types\Message;

it('can create a default alert', function () {
    Alert::message('Thank you!')->flash();

    $default = Alert::default('message');

    expect($default)->toBeInstanceOf(MessageInterface::class);
    expect($default)->toBeInstanceOf(Message::class);
    expect($default->message)->toEqual('Thank you!');
})->name('types', 'types-default', 'types-message');
