<div wire:ignore class="digitlimit-alert-notify">
    <div
        class="notify-container"
        x-data="{
                    notifications: [],
                    alerts: {{ $alerts }},
                    addAlerts() {
                        this.alerts.forEach(alert => {
                        alert.autoClose = alert.timeout > 0;
                        alert.buttons = Array.isArray(alert.buttons) ? alert.buttons : [];

                        alert.buttons.forEach(button => {
                            button.attributes = {};
                        });

                        this.notifications.push(alert);

                        if (alert.autoClose) {
                            setTimeout(() => { this.dismiss(alert.id); }, alert.timeout);
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
                        <template x-for="button in notification.buttons">
                            <template x-if="button.name === 'action'">
                                <template x-if="button.link">
                                    <a
                                        x-show="true"
                                        :href="button.link"
                                        class="action-button"
                                        x-bind="button.attributes ?? {}"
                                        x-text="button.label"
                                        style="background: #1d0002; padding: 10px;"
                                    >
                                        hhh
                                    </a>
                                </template>
                                <template x-if="!button.link">
                                    <button
                                        x-show="true"
                                        @click="dismiss(notification.id)"
                                        class="action-button"
                                        x-bind="button.attributes ?? {}"
                                        x-text="button.label"
                                        style="background: #1d0002; padding: 10px;"
                                    >
                                        66
                                    </button>
                                </template>
                            </template>

                            <template x-show="button.name === 'cancel'">
                                <template x-if="button.link">
                                    999
                                    <a
                                        :href="button.link"
                                        class="cancel-button"
                                        x-bind="button.attributes ?? {}"
                                        x-text="button.label"
                                        style="background: #1d0002; padding: 10px;"
                                    ></a>
                                </template>
                                <template x-if="!button.link">
                                    <button
                                        @click="dismiss(notification.id)"
                                        class="cancel-button"
                                        x-bind="button.attributes ?? {}"
                                        x-text="button.label"
                                        style="background: #1d0002; padding: 10px;"
                                    ></button>
                                </template>
                            </template>

                            <template x-show="!['action', 'cancel'].includes(button.name)">
                                <template x-if="button.link">
                                    <a
                                        :href="button.link"
                                        x-bind="button.attributes ?? {}"
                                        x-text="button.label"
                                        style="background: #1d0002; padding: 10px;"
                                    >
                                    </a>
                                </template>
                                <template x-if="!button.link">
                                    <button
                                        x-bind="button.attributes ?? {}"
                                        x-text="button.label"
                                        style="background: #1d0002; padding: 10px;"
                                    >
                                    </button>
                                </template>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
