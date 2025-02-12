@php
    $id     = $attributes->get('id'); 
    $tag    = $attributes->get('tag', $defaultTag);
    $sticky = $alert->tagged('sticky', $tag);
    $action = $sticky->action ?? '';
    $theme  = $attributes->get('theme', 'light');
@endphp
@if($sticky)
    @php
        $id = $id ?? $sticky->id;
    @endphp

    <div data-bs-theme="{{$theme}}" id="{{$id}}" {{ $attributes->merge(['class' => 'alert alert-dismissible alert-'.$sticky->getLevel()]) }} role="alert">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($sticky->getTitle())<strong>{{ $sticky->getTitle() }}</strong>@endif {{ $sticky->getMessage() }}

            @if($action->label)
                @if($action->link)
                    <a href="{{ $action->link }}" {!! $actionAttributes($action->attributes) !!}>
                        {{ $action->label }}
                    </a>
                @else
                    <button {!! $actionAttributes($action->attributes) !!}>
                        {{ $action->label }}
                    </button>
                @endif
            @endif

        @endif
    </div>
@endif