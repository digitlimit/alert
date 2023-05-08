@php
    $tag    = $attributes->get('tag', $defaultTag); 
    $id     = $attributes->get('id', $id); 
    $notify = $alert->tagged('notify', $tag);
    $view   = $notify->view ?? '';
    $css    = 'top-50 start-50 translate-middle';
@endphp
@if($notify)
    @php
        $hasTitle  = (isset($header) && $header->isEmpty()) && empty($notify->title);
        $hasBody   = isset($body) && $body->isEmpty();
        $hasHeader = isset($header) && $header->isEmpty();
    @endphp
    <div 
        {{ $attributes->merge(['class'   => 'position-fixed p-3 ' . $css]) }}
        {{ $attributes->merge(['z-index' => '11']) }}
    >
        <div id="{{ $id }}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            
            @if($hasTitle)
                <div {{ isset($header) ? $header->attributes->class(['toast-header']) : 'class=toast-header' }}>
                    @if ($hasHeader)
                        {{ $header }}
                    @elseif($notify->title)
                        <strong class="{{ $notify->level ? 'text-' . $notify->level : '' }}">
                            {{ $notify->title }}
                        </strong>
                        <small class="text-muted">{{ $notify->title }}</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    @endif
                </div>
            @endif

            @if($view)
                {!! $view !!}
            @elseif(!$hasTitle)
                <div class="d-flex">
                    
                    <div {{ isset($body) ? $body->attributes->class(['toast-body']) : 'class=toast-body' }}>
                        @if($hasBody)
                            {{ $body }}
                        @elseif($notify->message)
                            {{ $notify->message }}
                        @endif
                    </div>

                    @if(!$hasBody)
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    @endif
                </div>
            @else
                <div {{ isset($body) ? $body->attributes->class(['toast-body']) : 'class=toast-body' }}>
                    @if($hasBody)
                        {{ $body }}
                    @elseif($notify->message)
                        {{ $notify->message }}
                    @endif
                </div>
            @endif

        </div>
    </div>
    <script>
        (function(){
            var toastElement = document.getElementById('{{ $id }}');
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        })();
    </script>
@endif