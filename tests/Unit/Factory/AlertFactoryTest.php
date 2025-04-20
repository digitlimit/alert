<?php

use Digitlimit\Alert\Factory\AlertFactory;
use Digitlimit\Alert\Foundation\AlertInterface;

it('creates an alert using make()', function () {
    $alert = AlertFactory::make('message', 'Hello World');

    expect($alert)->toBeInstanceOf(AlertInterface::class)
        ->and($alert->getMessage())
        ->toBe('Hello World');
})->group('unit', 'factory', 'alert-factory');

it('creates an alert using makeFromArray()', function () {
    $alert = AlertFactory::makeFromArray([
        'id'      => 1,
        'title'   => 'Test Alert',
        'level'   => 'info',
        'tag'     => 'default',
        'type'    => 'message',
        'message' => 'Hello World',
    ]);

    expect($alert)->toBeInstanceOf(AlertInterface::class)
        ->and($alert->getMessage())
        ->toBe('Hello World');
})->group('unit', 'factory', 'alert-factory');
