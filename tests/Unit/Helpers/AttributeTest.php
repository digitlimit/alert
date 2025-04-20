<?php

use Digitlimit\Alert\Helpers\Attribute;

it('can generate html element attribute from an array', function () {
    $attributesString = Attribute::toString([
        'id'    => 'alert-id',
        'class' => 'hover:underline to-pink-500',
    ]);

    expect($attributesString)
        ->toEqual('id="alert-id" class="hover:underline to-pink-500"');
})->group('helpers', 'helpers-to-string');
