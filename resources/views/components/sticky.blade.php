@php
    $tag    = $attributes->get('tag', $defaultTag);
    $sticky = $alert->tagged('sticky', $tag);
@endphp
@if($sticky)
    <div {{ $attributes->merge(['class' => 'alert alert-'.$sticky->level]) }} role="alert">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($sticky->title)<strong>{{ $sticky->title }}</strong>@endif {{ $sticky->message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
@endif