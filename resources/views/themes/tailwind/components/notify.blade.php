<div wire:ignore class="digitlimit-alert-notify">
    @inject('alert', 'Digitlimit\Alert\Alert')
    @php
        $notify = $alert->fromArray($data);
    @endphp

    <div x-data="{
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
}" class="notify-container" @open-alert-notify.window="addNotification('{{ $notify->getMessage() }}', '{{ $notify->getLevel() }}', {{ $notify->getTimeOut() }})">

        <template x-for="notification in notifications" :key="notification.id">
            <div :class="'notify ' + notification.type" class="notify-content">
                <div class="relative flex flex-1 items-center gap-3">
                    <div class="relative z-20">
                        <template x-if="notification.type === 'success'">
                            <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="11" stroke="#11FFB6" stroke-opacity="0.231373" stroke-width="2"></circle>
                                <path d="M8.45703 12.6263L10.332 14.7096L15.5404 9.29297" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </template>
                    </div>
                    <div>
                        <div class="notify-message" x-text="notification.message"></div>
                    </div>
                </div>
                <button @click="removeNotification(notification.id)" class="notify-button">Close</button>
                <template x-if="notification.autoClose">
                    <div class="notify-progress" :style="'animation-duration: ' + notification.timeout + 'ms;'"></div>
                </template>
            </div>
        </template>
    </div>
</div>