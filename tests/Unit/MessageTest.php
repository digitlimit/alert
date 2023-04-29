<?php
use Digitlimit\Alert\Message;

it('can set message', function () {
    $message = new Message();
    $message->setTitle('Congratualtions!');

    expect($message->getTitle())->toBe('Congratualtions!');

});
