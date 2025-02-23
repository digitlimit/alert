<div x-data="{ show: true }" x-show="show"
     x-transition:enter="transition ease-out duration-300 transform opacity-0 scale-90"
     x-transition:enter-start="opacity-0 scale-90"
     x-transition:enter-end="opacity-100 scale-100"
     x-transition:leave="transition ease-in duration-200 transform opacity-0 scale-90"
     x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-90"
     id="toast-warning"
     class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800"
     role="alert">
    <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
        </svg>
        <span class="sr-only">Warning icon</span>
    </div>
    <div class="ms-3 text-sm font-normal">Improve password difficulty.</div>
    <button @click="show = false" type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>



{{--@php--}}
{{--    $tag      = $attributes->get('tag', $defaultTag); --}}
{{--    $id       = $attributes->get('id'); --}}
{{--    $notify   = $alert->tagged('notify', $tag);--}}
{{--    $view     = $notify->view ?? '';--}}
{{--    $position = $notify->position ?? 'bottom-0 end-0';--}}
{{--    $theme    = $attributes->get('theme', 'light');--}}
{{--@endphp--}}
{{--@if($notify)--}}
{{--    @php--}}
{{--        $id        = $id ?? $notify->id;--}}
{{--        $hasBody   = isset($body) && $body->isNotEmpty();--}}
{{--        $hasHeader = isset($header) && $header->isNotEmpty();--}}
{{--        $hasTitle  = $hasHeader || $notify->getTitle();--}}
{{--    @endphp--}}
{{--    <div data-bs-theme="{{$theme}}"--}}
{{--        {{ $attributes->merge(['class'   => 'position-fixed p-3 ' . $position]) }}--}}
{{--        {{ $attributes->merge(['z-index' => '100']) }}--}}
{{--    >--}}
{{--        <div id="{{ $id }}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">--}}
{{--            --}}
{{--            @if($hasTitle)--}}
{{--                <div {{ isset($header) ? $header->attributes->class(['toast-header']) : 'class=toast-header' }}>--}}
{{--                    @if ($hasHeader)--}}
{{--                        {{ $header }}--}}
{{--                    @elseif($notify->getTitle())--}}
{{--                        <strong class="me-auto {{ $notify->getLevel() ? 'text-' . $notify->getLevel() : '' }}">--}}
{{--                            {{ $notify->getTitle() }}--}}
{{--                        </strong>--}}
{{--                        <small class="text-muted">{{ $notify->subtitle ?? '' }}</small>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            @if($view)--}}
{{--                {!! $view !!}--}}
{{--            @elseif(!$hasTitle)--}}
{{--                <div class="d-flex">--}}
{{--                    --}}
{{--                    <div {{ isset($body) ? $body->attributes->class(['toast-body']) : 'class=toast-body' }}>--}}
{{--                        @if($hasBody)--}}
{{--                            {{ $body }}--}}
{{--                        @elseif($notify->getMessage())--}}
{{--                            {{ $notify->getMessage() }}--}}
{{--                        @endif--}}
{{--                    </div>--}}

{{--                    @if(!$hasBody)--}}
{{--                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            @else--}}
{{--                <div {{ isset($body) ? $body->attributes->class(['toast-body']) : 'class=toast-body' }}>--}}
{{--                    @if($hasBody)--}}
{{--                        {{ $body }}--}}
{{--                    @elseif($notify->getMessage())--}}
{{--                        {{ $notify->getMessage() }}--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            @endif--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    <script>--}}
{{--        (function(){--}}
{{--            var toastElement = document.getElementById('{{ $id }}');--}}
{{--            var toast = new bootstrap.Toast(toastElement);--}}
{{--            toast.show();--}}
{{--        })();--}}
{{--    </script>--}}
{{--@endif--}}
