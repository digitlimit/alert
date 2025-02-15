<?php

use Digitlimit\Alert\Component\Button;
use Digitlimit\Alert\Facades\Alert;
use Digitlimit\Alert\Message\MessageInterface;
use Digitlimit\Alert\Types\Sticky;

it('can create a sticky alert', function () {
    Alert::sticky('Thank you!');

    $default = Alert::default('sticky');

    expect($default)
        ->toBeInstanceOf(MessageInterface::class)
        ->and($default)
        ->toBeInstanceOf(Sticky::class)
        ->and($default->message)
        ->toEqual('Thank you!');
})->group('types', 'types-sticky', 'types-sticky-message');

it('can create a sticky alert title', function () {
    Alert::sticky('Thank for ordering pizza!')
        ->title('Order');

    $default = Alert::default('sticky');

    expect($default->title)
        ->toEqual('Order')
        ->and($default->message)
        ->toEqual('Thank for ordering pizza!');
})->group('types', 'types-sticky', 'types-sticky-title');

it('can create a sticky alert button', function () {
    Alert::sticky()
        ->action('Yes');

    $default = Alert::default('sticky');

    expect($default->action)
        ->toBeInstanceOf(Button::class);
})->group('types', 'types-sticky', 'types-sticky-button');
