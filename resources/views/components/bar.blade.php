@php
    $tag = $attributes->get('tag', $defaultTag);
@endphp
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @else
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>