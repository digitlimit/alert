<?php

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Events\Field\Flashed;
use Digitlimit\Alert\Types\Field;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;

beforeEach(function () {
    Session::flush(); // Ensure clean session state
});

it('can create a field alert and get its properties', function () {
    $alert = new Field('email', 'Email is required');

    expect($alert->getName())->toBe('email')
        ->and($alert->getMessage())->toBe('Email is required')
        ->and($alert->getLevel())->toBe('error') // default level
        ->and($alert->key())->toBe('field')
        ->and($alert->getTag())->toBe('default')
        ->and($alert->getNamedTag())->toBe('default.email');
})->group('field', 'create');

it('can convert the field alert to array', function () {
    $alert = new Field('email', 'Invalid email');
    $alert->level('warning')->tag('user');

    $array = $alert->toArray();

    expect($array)->toMatchArray([
        'id'        => $alert->getId(),
        'type'      => 'field',
        'name'      => 'email',
        'tag'       => 'user',
        'named_tag' => 'user.email',
        'level'     => 'warning',
        'message'   => 'Invalid email',
        'timeout'   => 0,
    ]);
})->group('field', 'toArray');

it('can fill a field alert from array', function () {
    $data = [
        'id'      => 'alert-id',
        'name'    => 'password',
        'message' => 'Password must be at least 6 characters',
        'tag'     => 'auth',
        'level'   => 'info',
    ];

    $alert = Field::fill($data);

    expect($alert->getId())->toBe('alert-id')
        ->and($alert->getName())->toBe('password')
        ->and($alert->getMessage())->toBe('Password must be at least 6 characters')
        ->and($alert->getTag())->toBe('auth')
        ->and($alert->getLevel())->toBe('info');
})->group('field', 'fill');

it('can flash the field alert to session', function () {
    Event::fake();

    $alert = new Field('username', 'Username is required');
    $alert->tag('register');

    $sessionKey = Alert::MAIN_KEY.'.field.register.username';

    $alert->flash();

    expect(Session::get($sessionKey))->toBeInstanceOf(Field::class)
        ->and(Session::get($sessionKey)->getMessage())->toBe('Username is required');

    Event::assertDispatched(Flashed::class, function ($event) use ($alert) {
        return $event->alert === $alert;
    });
})->group('field', 'flash');

it('does not flash an alert with empty name or message', function () {
    Session::flush();
    Event::fake();

    $alert = new Field('', '');
    $alert->flash();

    expect(Session::all())->toBeEmpty();
    Event::assertNothingDispatched();
})->group('field', 'flash', 'empty');
