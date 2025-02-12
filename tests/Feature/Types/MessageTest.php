<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Types\Message;

it('can create a default alert', function () {
    Alert::message('Thank you!');

    $default = Alert::default('message');

    expect($default)
        ->toBeInstanceOf(MessageInterface::class)
        ->and($default)
        ->toBeInstanceOf(Message::class)
        ->and($default->message)
        ->toEqual('Thank you!');

})->group('types', 'types-default', 'types-message');
