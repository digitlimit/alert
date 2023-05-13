<?php

// namespace Digitlimit\Alert\View\Components;

// use Closure;
// use Illuminate\Contracts\View\View;
// use Illuminate\View\Component;
// use Digitlimit\Alert\Alert;
// use Digitlimit\Alert\Helpers\Attribute;

// class Sticky extends Component
// {
//     public string $defaultTag = 'default';

//     public Alert $alert;

//     public array $actionAttributes = [
//         'type'  => 'button', 
//         'class' => 'btn btn-sm btn-primary float-end'
//     ];

//     /**
//      * Create a new component instance.
//      */
//     public function __construct(Alert $alert)
//     {
//         $this->alert = $alert;
//     }

//     /**
//      * Get the view / contents that represent the component.
//      */
//     public function render(): View|Closure|string
//     {
//         return view('alert::components.sticky');
//     }

//     public function actionAttributes(array $attributes) : string 
//     {
//         $newAttributes = array_merge(
//             $this->actionAttributes, 
//             $attributes
//         );

//         return Attribute::toString($newAttributes);
//     }
// }
