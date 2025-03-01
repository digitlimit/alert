<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Types\Alert;

it('can create a default alert', function () {
    Alert::message('Thank you!');

    $default = Alert::default('message');

    expect($default)
        ->toBeInstanceOf(AlertInterface::class)
        ->and($default)
        ->toBeInstanceOf(Alert::class)
        ->and($default->getMessage())
        ->toEqual('Thank you!');

})->group('types', 'types-default', 'types-message');
