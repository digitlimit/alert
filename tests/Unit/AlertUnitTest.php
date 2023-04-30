<?php
use Digitlimit\Alert\Message;
use Digitlimit\Alert\Enums\Level;

it('has alert with the given message', function () 
{
    $alert = alert();
    $alert->message('Thank you!');

    $alerter = $alert->alerter();
    expect($alerter->getMessage())->toEqual(new Message('Thank you!'));
})->name('alert', 'alert-message');

it('has alert with the given tag', function () 
{
    $alert = alert();
    $alert->tag('page footer');

    $alerter = $alert->alerter();
    expect($alerter->getKey())->toBe('digitlimit.alert.page-footer');
})->name('alert', 'alert-tag');

it('has alert with the given info level', function () 
{
    $alert = alert();
    $alert->info();

    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(Level::INFO);
})->name('alert', 'alert-info-level');

it('has alert with the given success level', function () 
{
    $alert = alert();
    $alert->success();

    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(Level::SUCCESS);
})->name('alert', 'alert-success-level');

it('has alert with the given error level', function () 
{
    $alert = alert();
    $alert->error();

    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(Level::ERROR);
})->name('alert', 'alert-error-level');

it('has alert with the given warning level', function () 
{
    $alert = alert();
    $alert->warning();

    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(Level::WARNING);
})->name('alert', 'alert-warning-level');

it('has alert with the given success level as deafult', function () 
{
    $alert = alert();
  
    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(Level::SUCCESS);
})->name('alert', 'alert-success-level-default');