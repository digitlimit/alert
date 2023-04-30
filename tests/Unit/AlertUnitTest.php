<?php
use Digitlimit\Alert\Message;
use Digitlimit\Alert\Enums\LevelType;

it('has alert with given message', function () 
{
    $alert = alert();
    $alert->message('Thank you!');

    $alerter = $alert->alerter();
    expect($alerter->getMessage())->toEqual(new Message('Thank you!'));
});

it('has alert with given tag', function () 
{
    $alert = alert();
    $alert->tag('page footer');

    $alerter = $alert->alerter();
    expect($alerter->getKey())->toBe('digitlimit.alert.page-footer');
});

it('has alert with info level', function () 
{
    $alert = alert();
    $alert->info();

    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(LevelType::INFO);
});

it('has alert with success level', function () 
{
    $alert = alert();
    $alert->success();

    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(LevelType::SUCCESS);
});

it('has alert with error level', function () 
{
    $alert = alert();
    $alert->error();

    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(LevelType::ERROR);
});

it('has alert with warning level', function () 
{
    $alert = alert();
    $alert->warning();

    $alerter = $alert->alerter();
    expect($alerter->getLevel()->type())->toEqual(LevelType::WARNING);
});
