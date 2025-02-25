<?php

namespace Digitlimit\Alert\Themes\Tailwind;

use Digitlimit\Alert\Alert;
use Digitlimit\Alert\Contracts\LivewireInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\MessageBag;
use Livewire\Attributes\On;
use Livewire\Component;

class Field extends Component implements LivewireInterface
{
    /**
     * The default alert tag.
     */
    public string $defaultTag = Alert::DEFAULT_TAG;

    /**
     * The alert name
     */
    public string $name;

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
                'main' => 'p-3 border-l-4 rounded-md bg-green-100 border-green-500 text-green-800',
            ],
        ],
        'error' => [
            'classes' => [
                'main' => 'p-3 border-l-4 rounded-md bg-red-100 border-red-500 text-red-800',
            ],
        ],
        'warning' => [
            'classes' => [
                'main' => 'p-3 border-l-4 rounded-md bg-yellow-100 border-yellow-500 text-yellow-800',
            ],
        ],
        'info' => [
            'classes' => [
                'main' => 'p-3 border-l-4 rounded-md bg-blue-100 border-blue-500 text-blue-800',
            ],
        ],
    ];

    /**
     * Set data for the alert.
     */
    public function setUp(array $data): void
    {
        $this->data = $data;
    }

    /**
     * Create a new component instance.
     *
     * @throws Exception
     */
    public function mount(): void
    {
        $this->tag = $this->tag ?? $this->defaultTag;
        $field = Alert::namedField($this->name, $this->tag) ?? Alert::taggedField($this->tag);

        $data = $field?->toArray();

        if (empty($data)) {
            $this->skipRender();
            return;
        }

        $this->setUp($data);
    }

    #[On('refresh-alert-field')]
    public function refresh(string $tag, array $data): void
    {
        if (empty($data)) {
            return;
        }

        if ($this->tag !== $tag || $this->name !== $data['name']) {
            return;
        }

        $this->setUp($data);
        $this->dispatch('open-alert-field');
    }

    /**
     * Get Laravel errors.
     */
    public function getViewErrors(): MessageBag
    {
        $errors = session('errors');

        return $errors instanceof MessageBag
            ? $errors
            : new MessageBag();
    }

    /**
     * Get tagged view errors.
     */
    public function getTaggedViewErrors(string $tag): MessageBag
    {
        return $this->errors()->{$tag} ?? new MessageBag();
    }

    public function getViewFieldError(string $name, string $tag): ?string
    {
        $taggedErrors = $this->getTaggedViewErrors($tag);

        if($taggedErrors->has($name)) {
            return $taggedErrors->first($name);
        }

        $viewErrors = $this->getViewErrors();

        if($viewErrors->has($name)) {
            return $viewErrors->first($name);
        }

        return null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('alert::components.themes.tailwind.field');
    }
}
