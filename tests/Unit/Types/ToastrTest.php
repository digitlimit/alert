<?php

use Digitlimit\Alert\Types\Toastr;
use Digitlimit\Alert\Events\Toastr\Flashed;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;

it('creates a toastr alert instance', function () {
    $toastr = new Toastr('Test message');

    expect($toastr)->toBeInstanceOf(Toastr::class)
        ->and($toastr->getMessage())->toBe('Test message')
        ->and($toastr->getLevel())->toBe('info') // Default level
        ->and($toastr->key())->toBe('toastr');
})->group('alert', 'toastr');

it('converts a toastr alert to array correctly', function () {
    $toastr = new Toastr('Test message');
    $toastr->title('Test Title')
        ->timeout(3000)
        ->tag('test-tag')
        ->level('success')
        ->position('top-right')
        ->closable(true);

    $array = $toastr->toArray();

    expect($array)->toMatchArray([
        'type' => 'toastr',
        'title' => 'Test Title',
        'timeout' => 3000,
        'message' => 'Test message',
        'tag' => 'test-tag',
        'level' => 'success',
        'position' => 'top-right',
        'closable' => true,
    ]);
})->group('alert', 'convert', 'toastr');

it('fills a toastr alert from an array', function () {
    $alertArray = [
        'id' => '123',
        'message' => 'Filled message',
        'title' => 'Filled Title',
        'timeout' => 5000,
        'tag' => 'filled-tag',
        'level' => 'error',
        'position' => 'bottom-left',
        'closable' => false,
    ];

    $toastr = Toastr::fill($alertArray);

    expect($toastr)->toBeInstanceOf(Toastr::class)
        ->and($toastr->getMessage())->toBe('Filled message')
        ->and($toastr->getTitle())->toBe('Filled Title')
        ->and($toastr->getTimeout())->toBe(5000)
        ->and($toastr->getTag())->toBe('filled-tag')
        ->and($toastr->getLevel())->toBe('error')
        ->and($toastr->getPosition())->toBe('bottom-left')
        ->and($toastr->isClosable())->toBeFalse();
})->group('alert', 'fill', 'toastr');

it('flashes a toastr alert correctly', function () {
    Session::shouldReceive('flash')->twice();
    Event::fake();

    $toastr = new Toastr('Flashed message');
    $toastr->flash();

    Event::assertDispatched(Flashed::class);
})->group('alert', 'flash', 'toastr');
