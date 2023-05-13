<?php

use Digitlimit\Alert\Helpers\Attribute;

it('can generate html element attribute from an array', function () 
{
    $attributesString = Attribute::toString([
        'id'    => 'alert-id',
        'class' => 'alert alert-success'
    ]);

    expect($attributesString)
        ->toEqual('id="alert-id" class="alert alert-success"');
   
})->name('helpers', 'helpers-to-string');