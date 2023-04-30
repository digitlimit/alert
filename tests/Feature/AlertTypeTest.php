<?php
use Digitlimit\Alert\Enums\Type;

it('has alert with the given bar type', function () 
{
    $alert = alert();
    $alert->bar();

    $alerter = $alert->alerter();
    expect($alerter->getType()->name())->toEqual(Type::BAR);
})->name('alert-type', 'alert-bar-type');

it('has alert with the given field type', function () 
{
    $alert = alert();
    $alert->field();

    $alerter = $alert->alerter();
    expect($alerter->getType()->name())->toEqual(Type::FIELD);
})->name('alert-type', 'alert-field-type');

it('has alert with the given modal type', function () 
{
    $alert = alert();
    $alert->modal();

    $alerter = $alert->alerter();
    expect($alerter->getType()->name())->toEqual(Type::MODAL);
})->name('alert-type', 'alert-modal-type');

it('has alert with the given notify type', function () 
{
    $alert = alert();
    $alert->notify();

    $alerter = $alert->alerter();
    expect($alerter->getType()->name())->toEqual(Type::NOTIFY);
})->name('alert-type', 'alert-notify-type');

it('has alert with the given sticky type', function () 
{
    $alert = alert();
    $alert->sticky();

    $alerter = $alert->alerter();
    expect($alerter->getType()->name())->toEqual(Type::STICKY);
})->name('alert-type', 'alert-sticky-type');

it('has alert with the given bar type as deafult', function () 
{
    $alert = alert();
  
    $alerter = $alert->alerter();
    expect($alerter->getType()->name())->toEqual(Type::BAR);
})->name('alert-type', 'alert-bar-type-default');