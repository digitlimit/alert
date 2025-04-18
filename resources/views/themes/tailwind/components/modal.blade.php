<div class="digitlimit-alert-modal">
    <div
        class="modal-container"
        x-data="{
            modals: @entangle('alerts'),
            dismiss(id) {
                this.modals = this.modals.filter(n => n.id !== id);
            }
        }"
    >
        <template x-for="modal in modals" :key="modal.id">
            <div class="alert-modal" x-cloak>
                <!-- Background Overlay -->
                <div
                    class="modal-overlay"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click="dismiss(modal.id)"
                ></div>

                <!-- Modal Content -->
                <div
                    class="modal-content"
                    :class="{ 'scrollable': modal.scrollable, [modal.size]: true }"
                    x-trap="true"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                >
                    <!-- Modal Header -->
                    <div class="modal-header" :class="'text-' + modal.level">
                        <h3 class="modal-title" x-show="modal.title" x-text="modal.title"></h3>
                        <div class="relative w-10 h-10" x-data="{
                            radius: 9,
                            circumference: 2 * Math.PI * 9,
                            progress: 0,
                            startTimer(duration, id) {
                                if (!duration) return;

                                let start = null;
                                const step = (timestamp) => {
                                    if (!start) start = timestamp;
                                    const elapsed = timestamp - start;
                                    progress = Math.min(elapsed / duration, 1);
                                    this.progress = progress;

                                    if (progress < 1) {
                                        requestAnimationFrame(step);
                                    } else {
                                        $dispatch('close-modal', id);
                                    }
                                };
                                requestAnimationFrame(step);
                            }
                        }" x-init="startTimer(modal.timeout, modal.id)"
                             @close-modal.window="dismiss($event.detail)"
                        >
                            <!-- Circular Progress Border -->
                            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 24 24" fill="none">
                                <circle
                                        cx="12" cy="12" :r="radius"
                                        stroke="#e5e7eb" stroke-width="2" fill="none"
                                />
                                <circle
                                        cx="12" cy="12" :r="radius"
                                        stroke="currentColor"
                                        :stroke-dasharray="circumference"
                                        :stroke-dashoffset="circumference - (progress * circumference)"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        fill="none"
                                />
                            </svg>

                            <!-- Actual Close Button Icon -->
                            <button @click="dismiss(modal.id)" class="absolute inset-0 flex items-center justify-center z-10 text-gray-800 focus:outline-none">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <template x-if="modal.view">
                            <div x-html="modal.view"></div>
                        </template>
                        <template x-if="!modal.view && modal.message">
                            <div x-text="modal.message"></div>
                        </template>
                    </div>

                    <!-- Modal Footer Buttons -->
                    <div class="modal-footer">
                        <a
                                x-show="modal.has_action_button && modal.action_button.link !== null"
                                :href="modal.action_button.link"
                                @click="dismiss(modal.id)"
                                class="modal-action-button"
                                x-bind="modal.action_button.attributes"
                        >
                            <span x-text="modal.action_button.label"></span>
                        </a>

                        <button
                            x-show="modal.has_action_button && modal.action_button.link === null"
                            @click="dismiss(modal.id)"
                            class="modal-action-button"
                            x-bind="modal.action_button.attributes"
                        >
                            <span x-text="modal.action_button.label"></span>
                        </button>

                        <a
                            x-show="modal.has_cancel_button && modal.cancel_button.link !== null"
                            :href="modal.cancel_button.link"
                            @click="dismiss(modal.id)"
                            class="modal-cancel-button"
                            x-bind="modal.cancel_button.attributes"
                        >
                            <span x-text="modal.cancel_button.label"></span>
                        </a>

                        <button
                                x-show="modal.has_cancel_button && modal.cancel_button.link === null"
                                @click="dismiss(modal.id)"
                                class="modal-cancel-button"
                                x-bind="modal.cancel_button.attributes"
                        >
                            <span x-text="modal.cancel_button.label"></span>
                        </button>

                        <template x-for="button in modal.custom_buttons" :key="button.id">
                            <template x-if="button.link === null">
                                <button
                                    x-bind="button.attributes"
                                >
                                    <span x-text="button.label"></span>
                                </button>
                            </template>
                            <template x-if="button.link !== null">
                                <a
                                    :href="button.link"
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
