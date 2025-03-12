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
                    this.addNotification(
                        '{{ $notify->getMessage() }}',
                        '{{ $notify->getLevel() }}',
                         {{ $notify->getTimeOut() }},
                        '{{ $notify->hasTimeOut() }}'
                    );
                },
                addNotification(message, level = 'info', timeout = 5000, autoClose = true) {
                    let id = Date.now();
                    this.notifications.push({ id, message, level, timeout, autoClose });
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
                        <template x-if="notification.level === 'info'">
                            <x-alert-icon::info />
                        </template>
                        <template x-if="notification.level === 'success'">
                            <x-alert-icon::success />
                        </template>
                        <template x-if="notification.level === 'warning'">
                            <x-alert-icon::warning />
                        </template>
                        <template x-if="notification.level === 'error'">
                            <x-alert-icon::error />
                        </template>
                        <div>
                            <div class="notify-message" x-text="notification.message" />
                        </div>
                    </div>
                    <div class="notify-buttons">
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
