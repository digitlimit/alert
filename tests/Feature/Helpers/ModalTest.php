<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Types\Modal;

it('can create a modal alert with helper', function () {
    modal('Thank you!');

    $default = Alert::default('modal');

    expect($default)
        ->toBeInstanceOf(AlertInterface::class)
        ->and($default)
        ->toBeInstanceOf(Modal::class)
        ->and($default->message)
        ->toEqual('Thank you!');

})->group('types', 'types-modal', 'types-modal');
