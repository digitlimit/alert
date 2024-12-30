<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Types\Modal;

it('can create a modal alert with helper', function () {
    modal('Thank you!');

    $default = Alert::default('modal');

    expect($default)
        ->toBeInstanceOf(MessageInterface::class)
        ->and($default)
        ->toBeInstanceOf(Modal::class)
        ->and($default->message)
        ->toEqual('Thank you!');

})->group('types', 'types-modal', 'types-modal');
