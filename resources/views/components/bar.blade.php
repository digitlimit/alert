@php
    $tag = $attributes->get('tag', $defaultTag);
    $bar = $alert->tagged('bar', $tag);
@endphp
@if($bar)
    <div {{ $attributes->merge(['class' => 'alert alert-'.$bar->level]) }} role="alert">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($bar->title)<strong>{{ $bar->title }}</strong>@endif {{ $bar->message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
@endif