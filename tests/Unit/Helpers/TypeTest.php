<?php

use Digitlimit\Alert\Helpers\Type;

it('should return alert types', function () {
    $types = Type::types();

    expect($types)
        ->toBeArray()
        ->and($types)
        ->not->toBeEmpty();
})->group('helpers', 'helpers-type');

it('should return prefixed alert type', function () {
    $type = 'success';
    $prefixed = Type::prefixed($type);

    expect($prefixed)
        ->toEqual(Type::PREFIX.$type);
})->group('helpers', 'helpers-type');

it('should throw exception if alert type does not exist', function () {
    $type = 'unknown';

    Type::classname($type);
})->throws(
    Exception::class,
    "The alert type 'unknown' does not exist in config"
)->group('helpers', 'helpers-type');
