<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Types\Alert;

it('can create a default alert with helper', function () {
    alert('Thank you!');

    $default = Alert::default('message');

    expect($default)
        ->toBeInstanceOf(AlertInterface::class)
        ->and($default)
        ->toBeInstanceOf(Alert::class)
        ->and($default->message)
        ->toEqual('Thank you!');

})->group('types', 'types-default', 'types-message');
