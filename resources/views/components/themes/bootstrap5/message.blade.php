@php
    $id      = $attributes->get('id'); 
    $tag     = $attributes->get('tag', $defaultTag);
    $message = $alert->tagged('message', $tag);
@endphp
@if($message)
    @php
        $id = $id ?? $message->id;
    @endphp
    <div id="{{$id}}" {{ $attributes->merge(['class' => 'alert alert-dismissible alert-'.$message->level]) }} role="alert">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($message->title)<strong>{{ $message->title }}</strong>@endif {{ $message->message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
@endif