<?php
use Digitlimit\Alert\Message;
use Digitlimit\Alert\Enums\LevelType;

it('can alert', function () 
{
    $alert = alert();
    $alert
        ->tag('page footer')
        ->info()
        ->message('Thank you!');

    $alerter = $alert->alerter();
    
    expect($alerter->getKey())->toBe('digitlimit.alert.page-footer');
    expect($alerter->getLevel()->type())->toEqual(LevelType::INFO);
    expect($alerter->getMessage())->toEqual(new Message('Thank you!'));
});
