@php
    $tag    = $attributes->get('tag', $defaultTag);
    $normal = $alert->tagged('normal', $tag);
@endphp
@if($normal)
    <div {{ $attributes->merge(['class' => 'alert alert-dismissible alert-'.$normal->level]) }} role="alert">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($normal->title)<strong>{{ $normal->title }}</strong>@endif {{ $normal->message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
@endif