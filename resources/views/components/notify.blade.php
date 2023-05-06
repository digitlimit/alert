@php
    $tag    = $attributes->get('tag', $defaultTag);
    $notify = $alert->tagged('notify', $tag);
@endphp
@if($notify)
    <div {{ $attributes->merge(['class' => 'alert alert-'.$notify->level]) }} role="alert">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($notify->title)<strong>{{ $notify->title }}</strong>@endif {{ $notify->message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
@endif