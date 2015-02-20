# Alert
Alert is designed to make flashing messages in Laravel Applications a breeze. 
Tested and works in Laravel 5 or less


## Installation

Add alert in your composer.json file:

```php
"require": {
    "digitlimit/alert": "dev-master"
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
      Alert::form('Your account was successfully created','Congratulations')->success()->closable()->showIcon();
        
      return redirect()->route('users.getRegister');
   }
}
```

Then in your view your can include the flash message to your view like so:

```html
<div class"registration_form">

    @include('alert::form')
    
    <form method="POST" action="{{URL::route('users.postRegister')}}" novalidate>

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
Some where in the view layout:
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

Then just before </body>

```script
<script>
    $('#flash-overlay-modal').modal();
</script>
```

## Options and Chainable methods
show alert:
```php
Alert::form('Opps! Something went  wrong. Please try later.')->error();
Alert::notify('Thank you for applying','With Title')->success();
Alert::modal('Thank you for applying','With Title')->info();
```

Add a close button to alert:
```php
Alert::notify('Opps! Something went  wrong. Please try later.','Error')->error()->closable();
```

show icon in the alert:
```php
Alert::notify('Opps! Something went  wrong. Please try later.','Error')->error()->showIcon();
```

More chaining:
```php
Alert::notify('Opps! Something went  wrong. Please try later.','Error')->error()->showIcon()->closable;
```

## Other Options

If you don't wish to include alert view with @include('alert::form) or @include('alert::notify')

You can paste this in your view an customize as you wish

```php
@if (Session::has('alert_form_message'))

    <div class="alert alert-{{Session::get('alert_message_status')}}" style="display: block;">

        @if(Session::get('alert_message_closable'))
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @endif

        @if(Session::get('alert_message_title'))
            <strong>
                @if(Session::get('alert_message_icon')) <i class="{{Session::get('alert_message_icon')}}"></i> @endif

                {{Session::get('alert_message_title')}}
            </strong>
        @endif

        {{Session::get('alert_message')}}

    </div>

@endif
```
