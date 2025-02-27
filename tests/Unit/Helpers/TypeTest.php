<?php

use Digitlimit\Alert\Helpers\Type;

it('should return alert types', function () {
    $types = Type::types();

    expect($types)
        ->toBeArray()
        ->and($types)
        ->not->toBeEmpty();
});

it('should return prefixed alert type', function () {
    $type = 'success';
    $prefixed = Type::prefixed($type);

    expect($prefixed)
        ->toEqual(Type::PREFIX.$type);
});

it('should check if alert type exists', function () {
    $type = 'sticky';

    expect(Type::exists($type))
        ->toBeTrue();
});

it('should return alert type', function () {
    $type = 'sticky';
    $alertType = Type::type($type);

    expect($alertType)
        ->toBeArray()
        ->toHaveKey('view')
        ->toHaveKey('alert')
        ->toHaveKey('component');
});

it('should return alert class name', function () {
    $type = 'sticky';
    $className = Type::classname($type);

    expect($className)
        ->toBeString()
        ->toEqual(Type::type($type)['alert']);
});

it('should throw exception if alert type does not exist', function () {
    $type = 'unknown';

    Type::classname($type);
})->throws(
    Exception::class,
    "The alert type 'unknown' does not exist in config"
);
