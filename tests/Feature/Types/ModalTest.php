<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Types\Modal;
use Digitlimit\Alert\Message\MessageInterface;

it('can create a modal alert', function () 
{
    Alert::modal('Thank you!')->flash();

    $default = Alert::default('modal');

    expect($default)->toBeInstanceOf(MessageInterface::class);
    expect($default)->toBeInstanceOf(Modal::class);
    expect($default->message)->toEqual('Thank you!');

})->name('types', 'types-modal', 'types-modal');
