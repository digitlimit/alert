<div wire:ignore class="digitlimit-alert-toastr">
    <div
            class="fixed z-50 p-4"
            :class="position"
            x-data="{
            position: 'top-right',
            toasts: @entangle('alerts'),
            dismiss(id) {
                this.toasts = this.toasts.filter(n => n.id !== id);
            }
        }"
    >
        <template x-for="toast in toasts" :key="toast.id">
            <div
                    x-transition:enter="transition ease-in duration-200"
                    x-transition:enter-start="transform opacity-0 translate-y-2"
                    x-transition:enter-end="transform opacity-100"
                    x-transition:leave="transition ease-out duration-500"
                    x-transition:leave-start="transform translate-x-0 opacity-100"
                    x-transition:leave-end="transform -translate-y-2 opacity-0"
                    class="bg-gray-900 bg-gradient-to-r text-white rounded-t mb-3 shadow-lg flex items-center"
                    :class="{
                    'from-green-400 to-green-500': toast.level === 'success',
                    'from-red-400 to-pink-500': toast.level === 'error',
                    'from-yellow-400 to-yellow-500': toast.level === 'warning',
                    'from-blue-400 to-blue-500': toast.level === 'info',
                    'top-0 right-0': toast.position === 'top-right',
                    'top-0 left-0': toast.position === 'top-left',
                    'bottom-0 right-0': toast.position === 'bottom-right',
                    'bottom-0 left-0': toast.position === 'bottom-left',
                    'top-0 left-1/2 transform -translate-x-1/2': toast.position === 'top-center',
                    'bottom-0 left-1/2 transform -translate-x-1/2': toast.position === 'bottom-center',
                    'top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2': toast.position === 'center'
                }"
                    x-init="
                    position = toast.position

                    if (toast.timeout) {
                        setTimeout(() => dismiss(toast.id), toast.timeout);
                    }
                "
            >
                <div class="flex flex-col w-full">
                    <div class="flex items-center w-full px-1 my-2">
                        <div class="self-start px-1">
                            <svg x-show="toast.type == 'info'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="toast.type == 'success'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="toast.type == 'warning'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="toast.type == 'error'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>

                        <div class="py-3" x-text="toast.message"></div>

                        <div class="self-start px-1">
                            <button type="button" class="pt-0 px-1" @click="dismiss(toast.id)">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <progress
                            x-data="{ value : 0 }"
                            x-init="
                            setInterval(() => {
                                if(value == 100) clearInterval(); else value+=1
                            }, toast.timeout / 100)
                        "
                            max="100"
                            :value="value"
                            class="w-full h-1 p-0"
                    ></progress>
                </div>
            </div>
        </template>
    </div>
</div>