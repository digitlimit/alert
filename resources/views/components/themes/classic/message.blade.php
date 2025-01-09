@php
    $id      = $attributes->get('id'); 
    $tag     = $attributes->get('tag', $defaultTag);
    $message = $alert->tagged('message', $tag);
    $theme   = $attributes->get('theme', 'light');
@endphp
@if($message)
    @php
        $id = $id ?? $message->id;
    @endphp
    <div data-bs-theme="{{$theme}}" id="{{$id}}" {{ $attributes->merge(['class' => 'alert alert-dismissible alert-'.$message->getLevel()]) }} role="alert">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($message->getTitle())<strong>{{ $message->getTitle() }}</strong>@endif {{ $message->getMessage() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
@endif