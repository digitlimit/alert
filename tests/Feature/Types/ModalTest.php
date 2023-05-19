<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Types\Modal;

it('can create a modal alert', function () {
    Alert::modal('Thank you!')->flash();

    $default = Alert::default('modal');

    expect($default)->toBeInstanceOf(MessageInterface::class);
    expect($default)->toBeInstanceOf(Modal::class);
    expect($default->message)->toEqual('Thank you!');
})->name('types', 'types-modal', 'types-modal');
