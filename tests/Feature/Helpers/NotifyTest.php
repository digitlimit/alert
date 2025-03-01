<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Types\Notify;

it('can create a notify alert  with helper', function () {
    notify('Thank you!');

    $default = Alert::default('notify');

    expect($default)
        ->toBeInstanceOf(AlertInterface::class)
        ->and($default)
        ->toBeInstanceOf(Notify::class)
        ->and($default->message)
        ->toEqual('Thank you!')
        ->and($default->key())
        ->toEqual('notify');

})->group('types', 'types-notify', 'types-notify');
