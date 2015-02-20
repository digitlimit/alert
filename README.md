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

#### In your controller simply set your alert before redirection like so:

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
