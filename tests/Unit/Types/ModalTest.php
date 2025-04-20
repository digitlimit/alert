<?php

use Digitlimit\Alert\Events\Modal\Flashed;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Types\Modal;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;

beforeEach(function () {
    Session::flush();
});

it('can create a modal alert and get its default properties', function () {
    $alert = new Modal('This is a modal message');

    expect($alert->getMessage())->toBe('This is a modal message')
        ->and($alert->getLevel())->toBe('') // default is empty
        ->and($alert->getTimeout())->toBe(2000)
        ->and($alert->getTag())->toBe('default')
        ->and($alert->getSize())->toBe('medium')
        ->and($alert->getTitle())->toBeNull()
        ->and($alert->getView())->toBeNull()
        ->and($alert->isScrollable())->toBeTrue()
        ->and($alert->isClosable())->toBeTrue()
        ->and($alert->buttonsToArray())->toBe([])
        ->and($alert->key())->toBe('modal');
})->group('modal', 'create');

it('can convert the modal alert to array', function () {
    $alert = new Modal('Modal Message');

    $alert->tag('confirm')
        ->level('info')
        ->timeout(30)
        ->title('Confirm Action')
        ->scrollable(true)
        ->closable(true)
        ->setView('modals.confirm')
        ->buttons([
            ['name' => 'cancel', 'label' => 'Cancel'],
            ['name' => 'confirm', 'label' => 'Yes, Confirm'],
        ]);

    $array = $alert->toArray();

    expect($array)->toMatchArray([
        'id'         => $alert->getId(),
        'type'       => 'modal',
        'level'      => 'info',
        'title'      => 'Confirm Action',
        'message'    => 'Modal Message',
        'tag'        => 'confirm',
        'size'       => 'medium',
        'timeout'    => 30,
        'scrollable' => true,
        'closable'   => true,
        'view'       => 'modals.confirm',
        'buttons'    => [
            [
                'id'         => $alert->cancelButton()->getId(),
                'name'       => 'cancel',
                'label'      => 'Cancel',
                'link'       => null,
                'attributes' => [],
            ],
            [
                'id'         => $alert->customButtons()->first()->getId(),
                'name'       => 'confirm',
                'label'      => 'Yes, Confirm',
                'link'       => null,
                'attributes' => [],
            ],
        ],
    ]);
})->group('modal', 'toArray');

it('can fill a modal alert from an array', function () {
    $data = [
        'id'         => 'modal-123',
        'message'    => 'Do you want to continue?',
        'tag'        => 'dialog',
        'level'      => 'warning',
        'timeout'    => 15,
        'title'      => 'Continue?',
        'scrollable' => true,
        'closable'   => true,
        'view'       => 'modals.continue',
        'buttons'    => [
            ['name' => 'no', 'label' => 'No'],
            ['name' => 'yes', 'label' => 'Yes'],
        ],
    ];

    $alert = Modal::fill($data);

    expect($alert->getId())->toBe('modal-123')
        ->and($alert->getMessage())->toBe('Do you want to continue?')
        ->and($alert->getTag())->toBe('dialog')
        ->and($alert->getLevel())->toBe('warning')
        ->and($alert->getTitle())->toBe('Continue?')
        ->and($alert->getView())->toBe('modals.continue')
        ->and($alert->isScrollable())->toBeTrue()
        ->and($alert->isClosable())->toBeTrue()
        ->and($alert->buttonsToArray())->toHaveCount(2);
})->group('modal', 'fill');
//
it('can flash the modal alert to session and dispatch event', function () {
    Event::fake();

    $alert = new Modal('Flashing modal');
    $alert->tag('example');

    $alert->flash();

    $sessionKey = SessionKey::key('modal', 'example.'.$alert->getId());

    expect(Session::get($sessionKey))->toBeInstanceOf(Modal::class)
        ->and(Session::get($sessionKey)->getMessage())->toBe('Flashing modal');

    Event::assertDispatched(Flashed::class, function ($event) use ($alert) {
        return $event->alert === $alert;
    });
})->group('modal', 'flash');
