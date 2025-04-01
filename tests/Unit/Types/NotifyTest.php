<?php

use Digitlimit\Alert\Types\Notify;
use Digitlimit\Alert\Events\Notify\Flashed;
use Illuminate\Support\Facades\Session;

it('sets default level if none is provided', function () {
    $notify = new Notify('Test message');
    expect($notify->getLevel())->toBe('info');
})->group('notify', 'default');

it('returns correct key', function () {
    $notify = new Notify('Test message');
    expect($notify->key())->toBe('notify');
})->group('notify', 'key');

it('converts to array correctly', function () {
    $notify = new Notify('Test message');
    $notify->title('Test Title');
    $notify->timeout(5000);
    $notify->tag('test-tag');

    $array = $notify->toArray();

    expect($array)->toHaveKeys([
        'type', 'title', 'timeout', 'message', 'tag', 'id_tag', 'level', 'position', 'closable', 'buttons'
    ])->and($array['message'])->toBe('Test message')
        ->and($array['title'])->toBe('Test Title')
        ->and($array['tag'])->toBe('test-tag');
})->group('notify', 'array');

it('fills from array correctly', function () {
    $alertData = [
        'id' => '123',
        'message' => 'Filled message',
        'title' => 'Filled Title',
        'timeout' => 5000,
        'tag' => 'filled-tag',
        'level' => 'warning',
        'position' => 'top-right',
        'closable' => true,
        'buttons' => [],
    ];

    $notify = Notify::fill($alertData);

    expect($notify->getMessage())->toBe('Filled message')
        ->and($notify->getTitle())->toBe('Filled Title')
        ->and($notify->getTimeout())->toBe(5000)
        ->and($notify->getTag())->toBe('filled-tag')
        ->and($notify->getLevel())->toBe('warning')
        ->and($notify->getPosition())->toBe('top-right')
        ->and($notify->isClosable())->toBeTrue();
})->group('notify', 'fill');

it('flashes notification correctly', function () {
    Session::shouldReceive('flash')->once();
    Session::shouldReceive('forget')->once(); // Mock forget method to avoid exception

    $notify = new Notify('Flash message');
    $notify->id('flash-id');

    Flashed::fake();

    $notify->flash();

    Flashed::assertDispatched(fn ($event) => $event->alert === $notify);
});