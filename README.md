<h1>
   <img src="https://github.com/digitlimit/alert/assets/2041419/131bac3e-5406-4939-be5d-439945ff6a28">
</h1>

> Version 2.0

Alert is Laravel package for displaying different types of messages in Laravel application views.
It's designed to make flashing messages in Laravel Applications a breeze, with a lot of easy to use and fluent methods.

## Quick Start

1. Install Alert with composer:

```
composer require digitlimit/alert
```

2. Somewhere in the blade template

```
<x-alert-normal />
```

Example:

```
@extends('layouts.default')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-md-12">
        <x-alert-normal />
      </div>
    </div>

    <div class="row">
      @include('form.profile')
    </div>        
  </div>

  @include('partials.footer')
@endsection
```

NB: At the moment the alert components are built with Twitter Bootstrap 5, and can be customized to use other CSS classes.
Need to ensure bootstrap is included on the page.

3. Somewhere in the application

```
<?php

namespace App\Http\Controllers;

use Alert;

class DashboardController extends Controller
{
    public function index()
    {
        Alert::message('Welcome! Please complete your profile')
            ->info()
            ->flash();

        return view('home');
    }
}
```

4. Result

<img width="1052" alt="image" src="https://github.com/digitlimit/alert/assets/2041419/5cd28524-d78c-413a-a425-a92be1796e18">


## Documentation

Learn how to get started with Alert and then dive deeper into other and advanced topics:

[Complete documentation](https://github.com/digitlimit/alert/wiki)

## Change log

Coming soon

## Code of conduct

We will behave ourselves if you behave yourselves. For more details see our
[CODE_OF_CONDUCT.md](./CODE_OF_CONDUCT.md).

## Contributing

Please read through our [contributing guidelines](./CONTRIBUTING.md).  Included
are directions for opening issues.

## Versioning

Alert will be maintained under the Semantic Versioning guidelines as much as possible. Releases will be numbered
with the following format:

`<major>.<minor>.<patch>`

For more information on SemVer, please visit https://semver.org.

* Any release may update the design, look-and-feel, or branding of an existing
  icon
* We will never intentionally release a `patch` version update that breaks
  backward compatibility
* A `minor` release **may include backward-incompatible changes** but we will
  write clear upgrading instructions in UPGRADING.md
* A `minor` or `patch` release will never remove icons
* Bug fixes will be addressed as `patch` releases unless they include backward
  incompatibility then they will be `minor` releases

## License

Alert Free is free, open source, and GPL friendly. You can use it for
commercial projects, open source projects, or really almost whatever you want.

- Code — MIT License
  - In the Alert Free download, the MIT license applies all PHP files.

We've kept attribution comments terse, so we ask that you do not actively work
to remove them from files, especially code. They're a great way for folks to
learn about Alert.

