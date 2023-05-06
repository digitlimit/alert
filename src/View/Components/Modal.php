<?php

namespace Digitlimit\Alert\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Digitlimit\Alert\Alert;
use Illuminate\Support\Str;

class Modal extends Component
{
    public string $defaultTag = 'default';

    public string $id;

    public Alert $alert;

    public array $actionAttributes = [
        'type'            => 'button', 
        'class'           => 'btn btn-primary'
    ];

    public array $cancelAttributes = [
        'type'            => 'button', 
        'class'           => 'btn btn-secondary',
        'data-bs-dismiss' => 'modal'
    ];

    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
        $this->id    = 'modal' . Str::random(10);
    }

    public function render(): View|Closure|string
    {
        return view('alert::components.modal');
    }

    public function actionAttributes(array $attributes) : string 
    {
        $newAttributes = array_merge(
            $this->actionAttributes, 
            $attributes
        );

        return $this->attributesToString($newAttributes);
    }

    public function cancelAttributes(array $attributes) : string 
    {
        $newAttributes = array_merge(
            $this->cancelAttributes, 
            $attributes
        );

        return $this->attributesToString($newAttributes);
    }
    
    public function attributesToString(array $attributes) : string 
    {
        $newAttributes = array_map(function($key) use ($attributes) 
        {
       
            if(is_bool($attributes[$key])) {
                return $attributes[$key] ? $key :'';
            }

            return $key .'="' . $attributes[$key] . '"';

        }, array_keys($attributes));

        return join(' ', $newAttributes);
    }
}
