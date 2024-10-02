@php
    $id     = $attributes->get('id'); 
    $tag    = $attributes->get('tag', $defaultTag);
    $sticky = $alert->tagged('sticky', $tag);
    $action = $sticky->action ?? '';
@endphp
@if($sticky)
    @php
        $id = $id ?? $sticky->id;
    @endphp

    <div id="{{$id}}" {{ $attributes->merge(['class' => 'alert alert-dismissible alert-'.$sticky->level]) }} role="alert">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($sticky->title)<strong>{{ $sticky->title }}</strong>@endif {{ $sticky->message }}

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