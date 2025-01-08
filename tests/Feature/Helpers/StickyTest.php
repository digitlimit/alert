<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Types\Sticky;

it('can create a sticky alert  with helper', function () {
    sticky('Thank you!');

    $default = Alert::default('sticky');

    expect($default)
        ->toBeInstanceOf(MessageInterface::class)
        ->and($default)
        ->toBeInstanceOf(Sticky::class)
        ->and($default->message)
        ->toEqual('Thank you!');

})->group('types', 'types-sticky', 'types-sticky-message');
