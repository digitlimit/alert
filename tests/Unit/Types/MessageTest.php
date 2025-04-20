<?php

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Events\Message\Flashed;
use Digitlimit\Alert\Types\Message;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;

beforeEach(function () {
    Session::flush();
});

it('can create a message alert and get its default properties', function () {
    $alert = new Message('Something happened');

    expect($alert->getMessage())->toBe('Something happened')
        ->and($alert->getLevel())->toBe('info')
        ->and($alert->getTimeout())->toBe(0)
        ->and($alert->getTitle())->toBeNull()
        ->and($alert->isClosable())->toBeTrue()
        ->and($alert->key())->toBe('message')
        ->and($alert->getTag())->toBe('default');
})->group('message', 'create');

it('can convert the message alert to an array', function () {
    $alert = new Message('New update available');

    $alert->tag('updates')
        ->level('success')
        ->title('Update')
        ->timeout(10)
        ->closable(true);

    $array = $alert->toArray();

    expect($array)->toMatchArray([
        'id'       => $alert->getId(),
        'type'     => 'message',
        'tag'      => 'updates',
        'level'    => 'success',
        'message'  => 'New update available',
        'title'    => 'Update',
        'timeout'  => 10,
        'closable' => true,
    ]);
})->group('message', 'toArray');

it('can fill a message alert from array', function () {
    $data = [
        'id'       => 'alert-msg-1',
        'tag'      => 'dashboard',
        'level'    => 'warning',
        'message'  => 'Please verify your email',
        'title'    => 'Verification Needed',
        'closable' => true,
    ];

    $alert = Message::fill($data);

    expect($alert->getId())->toBe('alert-msg-1')
        ->and($alert->getTag())->toBe('dashboard')
        ->and($alert->getLevel())->toBe('warning')
        ->and($alert->getMessage())->toBe('Please verify your email')
        ->and($alert->getTitle())->toBe('Verification Needed')
        ->and($alert->isClosable())->toBeTrue();
})->group('message', 'fill');

it('can flash a normal message to session and dispatch event', function () {
    Event::fake();

    $alert = new Message('Welcome to the app');
    $alert->tag('intro');
    $alert->flash();

    $sessionKey = Alert::MAIN_KEY.'.message.default.'.$alert->getId();

    expect(Session::get($sessionKey))->toBeInstanceOf(Message::class)
        ->and(Session::get($sessionKey)->getMessage())->toBe('Welcome to the app');

    Event::assertDispatched(Flashed::class, function ($event) use ($alert) {
        return $event->alert === $alert;
    });
})->group('message', 'flash');
