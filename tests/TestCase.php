<?php

namespace Digitlimit\Alert\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Digitlimit\Alert\AlertServiceProvider;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class TestCase extends BaseTestCase
{
    use InteractsWithViews;

    protected function getPackageProviders($app)
    {
        return [
            AlertServiceProvider::class,
        ];
    }

    /**
     * Override application aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array<string, class-string<\Illuminate\Support\Facades\Facade>>
     */
    protected function getPackageAliases($app)
    {
        return [
          
        ];
    }
  
    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }

    public function packagePath(string $path='')
    {
        return __DIR__ . "/../" . $path;
    }
}