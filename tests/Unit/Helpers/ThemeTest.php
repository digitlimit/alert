<?php

use Digitlimit\Alert\Contracts\ThemeInterface;
use Digitlimit\Alert\Helpers\Theme;
use Illuminate\Support\Facades\Config;

it('can get the correct theme name', function () {
    $theme = Config::get('alert.theme');

    expect($theme)
        ->toEqual('tailwind')
        ->and(Theme::name())->toEqual('tailwind');
})->group('theme', 'helpers', 'theme-name');

it('can get all themes', function () {
    $themes = Config::get('alert.themes');
    $this->assertIsArray($themes);

    expect($themes)
        ->not()->toBeEmpty()
        ->toBeArray()
        ->toEqual(Theme::all());
})->group('theme', 'helpers', 'theme-all');

it('can throw exception if theme is not found', function () {
    // set a non-existent theme
    config(['alert.theme' => 'none']);

    expect(Theme::name())
        ->toEqual('none')
        ->and(Theme::theme());
})->throws(
    Exception::class,
    'Theme none not found'
)->group('theme', 'helpers', 'theme-not-found');

it('can get the correct theme instance', function () {
    // set a valid theme
    config(['alert.theme' => 'tailwind']);
    expect(Theme::name())
        ->toEqual('tailwind')
        ->and(Theme::theme())
        ->toBeInstanceOf(ThemeInterface::class);
})->group('theme', 'helpers', 'theme-instance');
