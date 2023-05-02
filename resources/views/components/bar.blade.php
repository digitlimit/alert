@php
    $tag     = $attributes->get('tag', $defaultTag);
    $alerter = $alert->tagged('contact');
@endphp
@if($alerter)
    @php
        $level   = $alerter->getLevel()->name()->value;
        $title   = $alerter->getMessage()->getTitle();
        $content = $alerter->getMessage()->getContent();
    @endphp
    <div {{ $attributes->merge(['class' => 'alert alert-'.$level]) }} role="alert">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($title)<strong>{{ $title }}</strong>@endif {{ $content }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
@endif