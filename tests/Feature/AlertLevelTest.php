<?php
use Digitlimit\Alert\Enums\Level;

it('has alert with the given info level', function () 
{
    $alert = alert();
    $alert->info();

    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(Level::INFO);
})->name('alert-level', 'alert-info-level');

it('has alert with the given success level', function () 
{
    $alert = alert();
    $alert->success();

    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(Level::SUCCESS);
})->name('alert-level', 'alert-success-level');

it('has alert with the given error level', function () 
{
    $alert = alert();
    $alert->error();

    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(Level::ERROR);
})->name('alert-level', 'alert-error-level');

it('has alert with the given warning level', function () 
{
    $alert = alert();
    $alert->warning();

    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(Level::WARNING);
})->name('alert-level', 'alert-warning-level');

it('has alert with the given success level as deafult', function () 
{
    $alert = alert();
  
    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(Level::SUCCESS);
})->name('alert-level', 'alert-success-level-default');