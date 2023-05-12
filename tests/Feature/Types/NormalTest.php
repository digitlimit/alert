<?php

use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Types\Normal;
use Digitlimit\Alert\Message\MessageInterface;

it('can create a default alert', function () 
{
    Alert::message('Thank you!')->flash();

    $default = Alert::default('normal');

    expect($default)->toBeInstanceOf(MessageInterface::class);
    expect($default)->toBeInstanceOf(Normal::class);
    expect($default->message)->toEqual('Thank you!');

})->name('types', 'types-default', 'types-normal');
