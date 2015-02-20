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

#### Service Provider
In Laravel 5 include service the provider within config/app.php or  app/config/app.php in Laravel 4

```php
'providers' => [
    'Digitlimit\Alert\AlertServiceProvider'
];
```

#### Facade
You can also include alert facade in aliases array in same file above

```php
'aliases' => [
    'Alert'     => 'Digitlimit\Alert\Facades\Alert'
];
```

## Usage

##### In your controller simply set your alert before redirection like so:

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

##### Then in your view your can include the flash message to your view like so:

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
      
