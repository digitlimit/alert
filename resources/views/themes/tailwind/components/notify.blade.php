<div wire:ignore class="digitlimit-alert-notify">
    <div
        class="notify-container fixed px-2 mt-3 overflow-x-hidden z-50"
        :class="position"
        x-data="{
            position: 'top-right',
            notifications: @entangle('alerts'),
            dismiss(id) {
                this.notifications = this.notifications.filter(n => n.id !== id);
            }
        }"
    >
        <template x-for="notify in notifications" :key="notify.id">
            <div class="notifies" style="opacity: 1; transform: translateY(0px);">
                <div
                    class="notify"
                    x-init="
                        if (notify.timeout) {
                            setTimeout(() => dismiss(notify.id), notify.timeout);
                        }
                    "
                >
                    <template x-if="notify.timeout">
                        <div class="notify-progress" :style="'animation-duration: ' + notify.timeout + 'ms;'"></div>
                    </template>

                    <div class="flex flex-1 items-center gap-4">
                        <div class="notify-content">
                            <template x-if="notify.level === 'info'">
                                <x-alert-icon::info />
                            </template>
                            <template x-if="notify.level === 'success'">
                                <x-alert-icon::success />
                            </template>
                            <template x-if="notify.level === 'warning'">
                                <x-alert-icon::warning />
                            </template>
                            <template x-if="notify.level === 'error'">
                                <x-alert-icon::error />
                            </template>
                            <div class="notify-message" x-text="notify.message" />
                        </div>
                    </div>

                    <div class="notify-buttons ml-auto">
                        <button
                            x-show="notify.has_action_button && notify.action_button.link === null"
                            @click="dismiss(notify.id)"
                            class="action-button"
                            x-bind="notify.action_button.attributes"
                        >
                            <span x-text="notify.action_button.label"></span>
                        </button>

                        <a
                            x-show="notify.has_action_button && notify.action_button.link !== null"
                            :href="notify.action_button.link"
                            @click="dismiss(notify.id)"
                            class="action-button"
                            x-bind="notify.action_button.attributes"
                        >
                            <span x-text="notify.action_button.label"></span>
                        </a>

                        <button
                            x-show="notify.has_cancel_button && notify.cancel_button.link === null"
                            @click="dismiss(notify.id)"
                            class="cancel-button"
                            x-bind="notify.cancel_button.attributes"
                        >
                            <span x-text="notify.cancel_button.label"></span>
                        </button>

                        <a
                            x-show="notify.has_cancel_button && notify.cancel_button.link !== null"
                            :href="notify.cancel_button.link"
                            @click="dismiss(notify.id)"
                            class="cancel-button"
                            x-bind="notify.cancel_button.attributes"
                        >
                            <span x-text="notify.cancel_button.label"></span>
                        </a>

                        <template x-for="button in notify.custom_buttons" :key="button.id">
                            <template x-if="button.link === null">
                                <button
                                    @click="dismiss(notify.id)"
                                    x-bind="button.attributes"
                                >
                                    <span x-text="button.label"></span>
                                </button>
                            </template>
                            <template x-if="button.link !== null">
                                <a
                                    :href="button.link"
                                    @click="dismiss(notify.id)"
                                    x-bind="button.attributes"
                                >
                                    <span x-text="button.label"></span>
                                </a>
                            </template>
                        </template>

                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
