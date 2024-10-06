@php
    $tag      = $attributes->get('tag', $defaultTag); 
    $id       = $attributes->get('id'); 
    $notify   = $alert->tagged('notify', $tag);
    $view     = $notify->view ?? '';
    $position = $notify->position ?? 'bottom-0 end-0';
@endphp
@if($notify)
    @php
        $id        = $id ?? $notify->id;
        $hasBody   = isset($body) && $body->isNotEmpty();
        $hasHeader = isset($header) && $header->isNotEmpty();
        $hasTitle  = $hasHeader || $notify->title;
    @endphp
    <div 
        {{ $attributes->merge(['class'   => 'position-fixed p-3 ' . $position]) }}
        {{ $attributes->merge(['z-index' => '100']) }}
    >
        <div id="{{ $id }}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            
            @if($hasTitle)
                <div {{ isset($header) ? $header->attributes->class(['toast-header']) : 'class=toast-header' }}>
                    @if ($hasHeader)
                        {{ $header }}
                    @elseif($notify->title)
                        <strong class="me-auto {{ $notify->level ? 'text-' . $notify->level : '' }}">
                            {{ $notify->title }}
                        </strong>
                        <small class="text-muted">{{ $notify->subtitle ?? '' }}</small>
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