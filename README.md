# Alert

[![Join the chat at https://gitter.im/digitlimit/alert](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/digitlimit/alert?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)  

Alert is designed to make flashing messages in Laravel Applications a breeze. 
Tested and works in Laravel 5 or less

### For this to work you need to include Twitter Bootstrap in your page

## Installation

Add alert in your composer.json file:

```php
"require": {
    "digitlimit/alert": "v1.0"
}
```

Then run 
```command
composer update
```

In Laravel 5 include Alert Service Provider within config/app.php or  app/config/app.php in Laravel 4

```php
'providers' => [
    'Digitlimit\Alert\AlertServiceProvider'
];
```

You can also include alert facade in aliases array in same file above i.e config/app.php or  app/config/app.php in Laravel 4

```php
'aliases' => [
    'Alert'     => 'Digitlimit\Alert\Facades\Alert'
];
```

## Usage

In your controller simply set your alert before redirection like so:

In laravel 5 controller for example:

```php
<?php namespace App\Http\Controllers;

use \Alert; //using Alert Facades

class UserController extends Controller
{
  public function postRegister(UserRegisterRequest $request)
  {
      Alert::form('Your account was successfully created','Congratulations')
      ->success()
      ->closable();
        
      return redirect()->route('users.getRegister');
   }
}


class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        /*run validation on request parameters*/
        $validator = validator($request->only(['email','password']), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        /*return errors to view if any*/
        if($validator->fails()){

            Alert::form('Some errors occured','Opps')
                ->error();

            return redirect()
                ->back()
                ->withErrors($validator);
        }
    }
}
```

Then in your view your can include the flash message to your view like so:

```html
<div class"registration_form">

    @include('alert::form')
    
    <form method="POST" action="{{route('users.postRegister')}}" novalidate>
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" id="first_name" class="form-control" name="first_name" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Email Address">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-success">Register</button>
        </form>
</div>
```   
##### Form Alert Example
![alert](https://user-images.githubusercontent.com/2041419/53573721-5fba5880-3b6e-11e9-9fb4-b13f245e7b90.JPG)


## Features
There are basically three types of alert messages you can flash

#### Form - used mostly to display message in the header of your form
  
Some where in the controller: 
```pph
//This simply displays a success message
Alert::form('Your account was successfully created','Congratulations')->success();
```
Some where in the view:
```html
@include('alert::form')
```

#### Notify - used mostly on the header of your page

Some where in the controller: 
```pph
//This simply displays a success message
Alert::notify('Your account is going to expire today.','Info')->info();
```
Some where in the view layout where you want the alert to appear:
```html
@include('alert::notify')
```

#### Modal - used mostly to display an overlay message

Some where in the controller: 
```php
//This simply displays a success message
Alert::modal('Thanks for joining us.','Title')->info();
```
Some where in the view layout:
```html
@include('alert::modal')
```

#### Customize alert views
To customized various alert views run artisan command below
```
   php artisan vendor:publish --provider="Digitlimit\Alert\AlertServiceProvider"
```

This will publish `form.blade.php`, `modal.blade.php`, `notify.blade.php` and `sticky.blade.php` 
to publish views to `resources/views/vendor/alert` directory. 

The following helpers can be used in blade templates

**Alert Icon**  
This displays alert icon class e.g fa fa-cog  
Example:
`<i class="{{Alert::icon()}}"></i>`

**Alert Status**  
This displays alert status  
Example:  
`<div class="alert alert-{{Alert::status()}}">`  

**Alert Title**  
This displays alert title  
Example:  
`<h1>{{Alert::title()}}</h1>`  

**Alert Message**  
This displays alert message  
Example:  
`<p>{{Alert::message()}}</p>`  

**Form alert customization example**  

```
@if(Alert::has('form'))
    <div class="alert alert-{{Alert::status()}}

        @if(Alert::closable()) alert-dismissible @endif fade show" role="alert">

        @if(Alert::icon())<i class="{{Alert::icon()}}"></i>@endif

        @if(Alert::title())<strong>{{Alert::title()}}</strong>@endif {{Alert::message()}}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
```


