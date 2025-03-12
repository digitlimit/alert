<div wire:ignore class="digitlimit-alert-notify">
    @inject('alert', 'Digitlimit\Alert\Alert')
    @inject('attributeHelper', 'Digitlimit\Alert\Helpers\Attribute')
    @php
        $notify = $alert->fromArray($data);
    @endphp
    <div
            class="notify-container"
            x-data="{
                notifications: [],
                init() {
                    this.addNotification('Welcome! Page loaded successfully.', 'info', 5000, true);
                },
                addNotification(message, type = 'info', timeout = 5000, autoClose = true) {
                    let id = Date.now();
                    this.notifications.push({ id, message, type, timeout, autoClose });
                    if (autoClose) {
                        setTimeout(() => { this.removeNotification(id); }, timeout);
                    }
                },
                removeNotification(id) {
                    this.notifications = this.notifications.filter(n => n.id !== id);
                }
            }"

            @open-alert-notify.window="addNotification(
                '{{ $notify->getMessage() }}',
                '{{ $notify->getLevel() }}',
                {{ $notify->getTimeOut() }},
                '{{ $notify->hasTimeOut() }}'
            )"
    >
        <template x-for="notification in notifications" :key="notification.id">
            <div class="notifies" style="opacity: 1; transform: translateY(0px);">
                <div class="notify">
                    <template x-if="notification.autoClose">
                        <div class="notify-progress" :style="'animation-duration: ' + notification.timeout + 'ms;'"></div>
                    </template>

                    <div class="notify-content">
                        <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="11" stroke="#FF9500" stroke-opacity="0.25" stroke-width="2"></circle>
                            <circle cx="12" cy="12" r="9" fill="#FF9500" fill-opacity="0.25" stroke="#FFB224" stroke-width="2"></circle>
                            <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v5"></path>
                            <path fill="#fff" stroke="#fff" d="M12.5 16.5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
                        </svg>
                        <div>
                            <div class="notify-message" x-text="notification.message" />
                        </div>
                    </div>
                    <div class="notify-buttons">
                        <button class="cancel-button" @click="removeNotification(notification.id)">
                            Reset
                        </button>
                        <button class="action-button" type="button" aria-haspopup="menu" aria-expanded="false" data-state="closed">
                            <span>Save</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" class="size-4 ml-2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.667 8.333L10 11.667l3.333-3.334"></path>
                            </svg>
                        </button>

                        @foreach($notify->getButtons() as $button)
                            @if($button->isAction())
                                @if($button->isLink())
                                    <a href="{{ $button->getLink() }}" class="modal-action-button" {!! $attributeHelper->toString($button->getAttributes()) !!}>
                                        {{ $button->getLabel() }}
                                    </a>
                                @else
                                    <button @click="removeNotification(notification.id)" class="modal-cancel-button" {!! $attributeHelper->toString($button->getAttributes()) !!}>
                                        {{ $button->getLabel() }}
                                    </button>
                                @endif
                            @elseif($button->isCancel())
                                @if($button->isLink())
                                    <a href="{{ $button->getLink() }}" class="modal-action-button" {!! $attributeHelper->toString($button->getAttributes()) !!}>
                                        {{ $button->getLabel() }}
                                    </a>
                                @else
                                    <button @click="removeNotification(notification.id)" class="modal-cancel-button" {!! $attributeHelper->toString($button->getAttributes()) !!}>
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
        </template>
    </div>
</div>