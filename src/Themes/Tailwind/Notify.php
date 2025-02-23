<?php

namespace Digitlimit\Alert\Themes\Tailwind;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Notify extends Component implements LivewireInterface
{
    /**
     * The default alert tag.
     */
    public string $defaultTag = Alert::DEFAULT_TAG;

    /**
     * The alert tag.
     */
    public string $tag;

    /**
     * The default alert class.
     */
    public array $classes;

    /**
     * The alert
     */
    public array $data = [];

    /**
     * The alert levels.
     */
    public array $levels = [
        'success' => [
            'classes' => [
                'main' => 'flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400',
                'close' => 'ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700'
            ],
        ],
        'error' => [
            'classes' => [
                'main' => 'flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400',
                'close' => 'ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700'
            ],
        ],
        'warning' => [
            'classes' => [
                'main' => 'flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300',
                'close' => 'ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-yellow-400 dark:hover:bg-gray-700'
            ],
        ],
        'info' => [
            'classes' => [
                'main' => 'flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400',
                'close' => 'ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700'
            ],
        ],
    ];

    /**
     * Set data for the alert.
     */
    public function setUp(array $data): void
    {
        $this->data = $data;
//        $this->classes = $this->levels[$data['level']]['classes'];
    }

    /**
     * Create a new component instance.
     */
    public function mount(): void
    {
        $this->tag = $this->tag ?? $this->defaultTag;
        $data = Alert::tagged('modal', $this->tag)?->toArray() ?? [];

        if(empty($data)) {
            $this->skipRender();
            return;
        }

        $this->setUp($data);
    }

    #[On('refresh-alert-notify')]
    public function refresh(string $tag, array $data): void
    {
        if($this->tag !== $tag || empty($data)) {
            return;
        }

        $this->setUp($data);
        $this->dispatch('open-alert-notify');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::components.themes.tailwind.notify');
    }
}
