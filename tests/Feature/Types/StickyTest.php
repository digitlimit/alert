<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Types\Sticky;

it('can create a sticky alert', function () {
    Alert::sticky('Thank you!')->flash();

    $default = Alert::default('sticky');

    expect($default)->toBeInstanceOf(MessageInterface::class);
    expect($default)->toBeInstanceOf(Sticky::class);
    expect($default->message)->toEqual('Thank you!');
})->name('types', 'types-sticky', 'types-sticky');
