<div class="digitlimit-alert-message">
    <div
        class="message-container"
        x-data="{
            messages: @entangle('alerts'),
            dismiss(id) {
                this.messages = this.messages.filter(n => n.id !== id);
            }
        }"
    >
        <template x-for="message in messages" :key="message.id">
            <div
                class="alert-message relative overflow-hidden"
                :class="message.level"
                x-transition.duration.300ms
                role="alert"
                x-init="
                    if (message.timeout) {
                        setTimeout(() => dismiss(message.id), message.timeout);
                    }
                "
            >
                <!-- Smooth Progress Bar with Dynamic Color -->
                <div
                    x-show="message.timeout"
                    class="absolute bottom-0 left-0 h-1"
                    style="width: 0%"
                    x-init="
                        requestAnimationFrame(() => {
                            $el.style.width = '100%';
                            $el.style.transition = `width ${message.timeout}ms linear`;
                        })
                    "
                    :class="{
                    'bg-blue-300': message.level === 'info',
                    'bg-green-300': message.level === 'success',
                    'bg-yellow-300': message.level === 'warning',
                    'bg-red-300': message.level === 'error'
                }"
                ></div>

                <!-- Icon -->
                <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>

                <!-- Message -->
                <span class="sr-only-fix" x-text="message.level"></span>

                <div class="message">
                    <h3 x-show="message.title !== null" class="title" x-text="message.title"></h3>
                    <p x-text="message.message"></p>
                </div>

                <!-- Close Button -->
                <button
                    @click="dismiss(message.id)"
                    type="button"
                    class="close"
                    :class="message.level"
                    aria-label="Close"
                >
                    <span class="sr-only-fix">Close</span>
                    <svg class="close-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        </template>
    </div>
</div>
