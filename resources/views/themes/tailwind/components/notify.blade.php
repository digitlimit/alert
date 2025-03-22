<div wire:ignore class="digitlimit-alert-notify">
    <div
            class="notify-container"
            x-data="{
                    notifications: [],
                    alerts: {{ $alerts }},
                    addAlerts() {
                        this.alerts.forEach(notify => {
                        notify.autoClose = notify.timeout > 0;
                        notify.buttons = Array.isArray(notify.buttons) ? notify.buttons : [];

                        // fix attributes
                        notify.buttons.forEach(button => {
                            if (Array.isArray(notify.buttons) && !button.attributes.length) {
                                button.attributes = {};
                            }
                        });
                        console.log(notify);

                        notify.actionButton = notify.buttons.filter(button => button.name === 'action')[0] ?? null;
                        notify.cancelButton = notify.buttons.filter(button => button.name === 'cancel')[0] ?? null;
                        notify.customButtons = notify.buttons.filter(button => !['action', 'cancel'].includes(button.name));
                        notify.hasActionButton = notify.actionButton !== null;
                        notify.hasCancelButton = notify.cancelButton.length !== null;
                        notify.hasCustomButtons = notify.customButtons.length > 0;

                        this.notifications.push(notify);

                        if (notify.autoClose) {
                            setTimeout(() => { this.dismiss(notify.id); }, notify.timeout);
                        }
                    });
                },
                init() {
                    this.addAlerts();
                },
                dismiss(id) {
                    this.notifications = this.notifications.filter(n => n.id !== id);
                }
            }"

            @open-alert-notify.window="addAlerts()"
    >
        <template x-for="notification in notifications" :key="notification.id">
            <div class="notifies" style="opacity: 1; transform: translateY(0px);">
                <div class="notify">
                    <template x-if="notification.autoClose">
                        <div class="notify-progress" :style="'animation-duration: ' + notification.timeout + 'ms;'"></div>
                    </template>

                    <div class="flex flex-1 items-center gap-4">
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
                            <div class="notify-message" x-text="notification.message" />
                        </div>
                    </div>

                    <div class="notify-buttons ml-auto">
                        <button
                            x-show="notification.hasActionButton && notification.actionButton.link === null"
                            @click="dismiss(notification.id)"
                            class="action-button"
                            x-bind="notification.actionButton.attributes"
                        >
                            <span x-text="notification.actionButton.label"></span>
                        </button>

                        <a
                            x-show="notification.hasActionButton && notification.actionButton.link !== null"
                            :href="notification.actionButton.link"
                            @click="dismiss(notification.id)"
                            class="action-button"
                            x-bind="notification.actionButton.attributes"
                        >
                            <span x-text="notification.actionButton.label"></span>
                        </a>

                        <button
                            x-show="notification.hasCancelButton && notification.cancelButton.link === null"
                            @click="dismiss(notification.id)"
                            class="cancel-button"
                            x-bind="notification.cancelButton.attributes"
                        >
                            <span x-text="notification.cancelButton.label"></span>
                        </button>

                        <a
                            x-show="notification.hasCancelButton && notification.cancelButton.link !== null"
                            :href="notification.cancelButton.link"
                            @click="dismiss(notification.id)"
                            class="cancel-button"
                            x-bind="notification.cancelButton.attributes"
                        >
                            <span x-text="notification.cancelButton.label"></span>
                        </a>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
