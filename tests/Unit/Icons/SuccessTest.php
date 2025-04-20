<?php

use Digitlimit\Alert\Icons\Success;
use Illuminate\Support\Facades\View;

it('is circled by default', function () {
    $component = new Success;

    expect($component->isCircled())->toBeTrue();
})->group('icons', 'success-icon');

it('renders the correct view', function () {
    View::shouldReceive('make')
        ->once()
        ->with('alert::icons.success', [], [])
        ->andReturn('rendered-view');

    $component = new Success;

    expect($component->render())->toBe('rendered-view');
})->group('icons', 'success-icon', 'view');
