<?php

use Digitlimit\Alert\Component\Button;

it('can instantiate a button and get its default values', function () {
    $button = new Button('submit');

    expect($button->getName())->toBe('submit')
        ->and($button->getLabel())->toBeNull()
        ->and($button->getLink())->toBeNull()
        ->and($button->getAttributes())->toBe([])
        ->and($button->isLink())->toBeFalse()
        ->and($button->isAction())->toBeFalse()
        ->and($button->isCancel())->toBeFalse();
})->group('buttons', 'defaults');

it('can set name, label, link, and attributes fluently', function () {
    $button = new Button('submit');

    $button->name('cancel')
        ->label('Cancel Button')
        ->link('/cancel')
        ->attributes(['class' => 'btn-cancel']);

    expect($button->getName())->toBe('cancel')
        ->and($button->getLabel())->toBe('Cancel Button')
        ->and($button->getLink())->toBe('/cancel')
        ->and($button->getAttributes())->toBe(['class' => 'btn-cancel'])
        ->and($button->isLink())->toBeTrue()
        ->and($button->isCancel())->toBeTrue();
})->group('buttons', 'setters');

it('can detect an action button', function () {
    $button = new Button('submit');
    $button->name('action');

    expect($button->isAction())->toBeTrue();
})->group('buttons', 'logic');

it('can convert the button to an array', function () {
    $button = new Button('submit', 'Submit Form', '/submit', ['class' => 'btn-submit']);

    $expected = [
        'name' => 'submit',
        'label' => 'Submit Form',
        'link' => '/submit',
        'attributes' => ['class' => 'btn-submit'],
    ];

    expect($button->toArray())->toBe($expected);
})->group('buttons', 'to-array');

it('can fill a button from an array', function () {
    $data = [
        'name' => 'delete',
        'label' => 'Delete Item',
        'link' => '/delete',
        'attributes' => ['class' => 'btn-danger'],
    ];

    $button = Button::fill($data);

    expect($button->getName())->toBe('delete')
        ->and($button->getLabel())->toBe('Delete Item')
        ->and($button->getLink())->toBe('/delete')
        ->and($button->getAttributes())->toBe(['class' => 'btn-danger']);
})->group('buttons', 'fill');
