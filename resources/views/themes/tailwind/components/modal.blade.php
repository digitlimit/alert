<div wire:ignore class="digitlimit-alert-modal">
    @inject('alert', 'Digitlimit\Alert\Alert')
    @inject('attributeHelper', 'Digitlimit\Alert\Helpers\Attribute')
    @php
        $modal  = $alert->fromArray($data);
        $header = $header ?? null;
        $body   = $body ?? null;
        $footer = $footer ?? null;
        $hasBody   = !is_null($body);
        $hasHeader = !is_null($header);
        $hasFooter = !is_null($footer);

        $hasTitle  = $hasHeader || $modal->getTitle();
    @endphp
    <div
            id="{{ $modal->getId() }}"

            x-data="{
                show: true,
                modalSize: '{{ $modal->getSize() }}',
                scrollable: {{ $modal->isScrollable() ? 'true' : 'false' }}
            }"

            @open-alert-modal.window="show = true"

            x-cloak
    >
        <div
                x-show="show"
                class="alert-modal"
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
                 class="modal-overlay">
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
                 class="modal-content {{ $modal->getSize() }} {{ $modal->isScrollable() ? 'scrollable' : '' }}"
            >

                <!-- Modal header -->
                <div class="modal-header {{ 'text-' . $modal->getLevel()}}">
                    @if($modal->hasTitle())
                        <h3 class="modal-title">{{ $modal->getTitle() }}</h3>
                    @endif
                    <button x-ref="modalCloseButton"
                            @click="show = false;"
                            class="modal-close"
                    >
                        <svg class="modal-close-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @if($modal->hasView())
                    {!! $modal->getView() !!}
                @else
                    <div class="modal-body">
                        @if($hasBody)
                            {{ $body }}
                        @elseif($modal->getMessage())
                            {{ $modal->getMessage() }}
                        @endif
                    </div>
                @endif

                <div class="modal-footer">
                    @foreach($modal->getButtons() as $button)
                        @if($button->isAction())
                            @if($button->isLink())
                                <a href="{{ $button->getLink() }}" class="modal-action-button" {!! $attributeHelper->toString($button->getAttributes()) !!}>
                                    {{ $button->getLabel() }}
                                </a>
                            @else
                                <button  class="modal-cancel-button" {!! $attributeHelper->toString($button->getAttributes()) !!}>
                                    {{ $button->getLabel() }}
                                </button>
                            @endif
                        @elseif($button->isCancel())
                            @if($button->isLink())
                                <a href="{{ $button->getLink() }}" class="modal-action-button" {!! $attributeHelper->toString($button->getAttributes()) !!}>
                                    {{ $button->getLabel() }}
                                </a>
                            @else
                                <button  class="modal-cancel-button" {!! $attributeHelper->toString($button->getAttributes()) !!}>
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
