<?php

use Digitlimit\Alert\Facades\Alert;

it('can render a default modal view component', function () 
{
    Alert::modal('Than you for joining us')
        ->flash();

    $view = $this
        ->blade('<x-alert-modal />');

    $view
        ->assertSee('class="modal"', false)
        ->assertSee('Than you for joining us');
  
})->name('view-component', 'view-component-modal-default');




// namespace Digitlimit\Alert\View\Components;

// use Closure;
// use Illuminate\Contracts\View\View;
// use Illuminate\View\Component;
// use Digitlimit\Alert\Alert;
// use Illuminate\Support\Str;
// use Digitlimit\Alert\Helpers\Attribute;

// class Modal extends Component
// {
//     public string $defaultTag = 'default';

//     public string $id;

//     public Alert $alert;

//     public array $actionAttributes = [
//         'type'            => 'button', 
//         'class'           => 'btn btn-primary'
//     ];

//     public array $cancelAttributes = [
//         'type'            => 'button', 
//         'class'           => 'btn btn-secondary',
//         'data-bs-dismiss' => 'modal'
//     ];

//     public function __construct(Alert $alert)
//     {
//         $this->alert = $alert;
//         $this->id    = 'modal' . Str::random(10);
//     }

//     public function render(): View|Closure|string
//     {
//         return view('alert::components.modal');
//     }

//     public function actionAttributes(array $attributes) : string 
//     {
//         $newAttributes = array_merge(
//             $this->actionAttributes, 
//             $attributes
//         );

//         return Attribute::toString($newAttributes);
//     }

//     public function cancelAttributes(array $attributes) : string 
//     {
//         $newAttributes = array_merge(
//             $this->cancelAttributes, 
//             $attributes
//         );

//         return Attribute::toString($newAttributes);
//     }
// }
