<?php

use Digitlimit\Alert\Icons\Error;
use Illuminate\Support\Facades\View;

it('is circled by default', function () {
    $component = new Error;

    expect($component->isCircled())->toBeTrue();
})->group('icons', 'error-icon');

it('renders the correct view', function () {
    View::shouldReceive('make')
        ->once()
        ->with('alert::icons.error', [], [])
        ->andReturn('rendered-view');

    $component = new Error;

    expect($component->render())->toBe('rendered-view');
})->group('icons', 'error-icon', 'view');
