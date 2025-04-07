<?php

use Digitlimit\Alert\Tests\Fixtures\DummyClosableClass;

it('can be set as closable', function () {
    $dummy = new DummyClosableClass();

    expect($dummy->closable(true)->isClosable())->toBeTrue();
});

it('can be set as not closable', function () {
    $dummy = new DummyClosableClass();

    $dummy->notClosable();

    expect($dummy->isClosable())->toBeFalse();
});

it('returns correct closable state', function () {
    $dummy = new DummyClosableClass();

    expect($dummy->isClosable())->toBeTrue(); // default is true

    $dummy->closable(false);
    expect($dummy->isClosable())->toBeFalse();

    $dummy->closable(true);
    expect($dummy->isClosable())->toBeTrue();
});
