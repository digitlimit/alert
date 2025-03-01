<?php

use Digitlimit\Alert\Component\Button;

it('can create button component', function () {
    $button = new Button(
        'submit',
        'Submit',
        '/about',
        ['class' => 'btn-sm']
    );

    expect($button->getLabel())->toEqual('Submit')
        ->and($button->getLink())->toEqual('/about')
        ->and($button->getAttributes())->toEqual(['class' => 'btn-sm']);

    $button->getLabel()('Register');
    $button->getLink()('/register');
    $button->getAttributes()(['id' => 'register']);

    expect($button->getLabel())->toEqual('Register')
        ->and($button->getLink())->toEqual('/register')
        ->and($button->getAttributes())->toEqual(['id' => 'register']);
})->group('component', 'component-button');
