<?php

namespace Digitlimit\Alert\Themes;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Digitlimit\Alert\Contracts\ThemeInterface;
use Digitlimit\Alert\Events;
use Digitlimit\Alert\Helpers\SessionKey;
use Digitlimit\Alert\Themes;
use Digitlimit\Alert\Types;
use Illuminate\Support\Facades\Event;
use Livewire\Component;
use Livewire\Livewire;

use function Livewire\on;
use function Livewire\store;

abstract class AbstractTheme implements ThemeInterface
{

}
