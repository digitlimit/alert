<div class="digitlimit-alert-modal">
    @inject('alert', 'Digitlimit\Alert\Alert')
    @php
        $modal  = $alert->fromArray($data);
        $header = $header ?? null;
        $body   = $body ?? null;
        $footer = $footer ?? null;

        $id        = $id ?? $modal->id;
        $view      = $modal->view ?? '';

        $hasBody   = !is_null($body);
        $hasHeader = !is_null($header);
        $hasFooter = !is_null($footer);

        $hasTitle  = $hasHeader || $modal->getTitle();
    @endphp
    <div
        x-data="{
            show: true,
            modalSize: '{{ $modal->getSize() }}',
            scrollable: {{ $modal->isScrollable() }}
        }"

        x-init="() => {
           show = true;
        }"

        @open-alert-modal.window="show = true"
    >
        <div
            x-show="show"
            class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
            x-cloak
            :inert="!show"
        >

            <!-- Background overlay, closes modal when clicked -->
            <div x-show="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 w-full h-full bg-white backdrop-blur-sm bg-opacity-70">
            </div>

            <!-- Modal content -->
            <div x-show="show"
                 x-trap="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"

                 :class="{
                     'w-1/4': modalSize === 'sm',        // Small
                     'w-1/2': modalSize === 'md',        // Medium
                     'w-3/4': modalSize === 'lg',        // Large
                     'w-full h-full': modalSize === 'full', // Full Screen
                      'max-h-[80vh] overflow-y-auto': scrollable // Enables scrolling inside modal
                 }"
                 class="bg-white p-6 rounded-lg shadow-lg relative max-w-full">

                <!-- Modal header -->
                @if ($hasHeader)
                    {{ $header }}
                @elseif($modal->getTitle())
                    <div class="flex items-center justify-between pb-3 {{ $modal->getLevel() ? 'text-' . $modal->getLevel() : '' }}">
                        <h3 class="text-lg font-semibold">{{ $modal->getTitle() }}</h3>
                        <button x-ref="modalCloseButton"
                                @click="show = false;"
                                class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50"
                        >
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Modal body -->
                @if($view)
                    {!! $view !!}
                @else
                    <div class="relative w-auto pb-8">
                        @if($hasBody)
                            {{ $body }}
                        @elseif($modal->getMessage())
                            {{ $modal->getMessage() }}
                        @endif
                    </div>
                @endif

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                    @foreach($modal->getButtons() as $button)
                        @if($button->isAction())
                           @if($button->isLink())
                                <a href="{{ $button->getLink() }}" {!! $actionLinkAttributes($button->getAttributes()) !!}>
                                    {{ $button->getLabel() }}
                                </a>
                            @else
                                <button {!! $actionAttributes($button->getAttributes()) !!}>
                                    {{ $button->getLabel() }}
                                </button>
                            @endif
                        @elseif($button->isCancel())
                            @if($button->isLink())
                                <a href="{{ $button->getLink() }}" {!! $cancelLinkAttributes($button->getAttributes()) !!}>
                                    {{ $button->getLabel() }}
                                </a>
                            @else
                                <button {!! $cancelAttributes($button->getAttributes()) !!}>
                                    {{ $button->getLabel() }}
                                </button>
                            @endif
                        @else
                            @if($button->isLink())
                                <a href="{{ $button->getLink() }}" {!! $button->getAttributes() !!}>
                                    {{ $button->getLabel() }}
                                </a>
                            @else
                                <button {!! $button->getAttributes() !!}>
                                    {{ $button->getLabel() }}
                                </button>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
