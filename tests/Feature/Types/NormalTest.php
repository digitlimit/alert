<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Types\Normal;

it('can create a default alert', function () {
    Alert::message('Thank you!')->flash();

    $default = Alert::default('normal');

    expect($default)->toBeInstanceOf(MessageInterface::class);
    expect($default)->toBeInstanceOf(Normal::class);
    expect($default->message)->toEqual('Thank you!');
})->name('types', 'types-default', 'types-normal');
