<div wire:ignore class="digitlimit-alert-notify">
    @inject('alert', 'Digitlimit\Alert\Alert')
    @php
        $notify    = $alert->fromArray($data);
    @endphp

    <div x-data="{ show: false, message: '', type: 'info', timeout: 5000 }"
         x-init="$watch('show', value => { if (value) setTimeout(() => show = false, timeout) })"
         class="toastr-container">

        <!-- Toast Notification -->
        <template x-if="show">
            <div :class="'toastr ' + type" class="toastr-content">
                <div class="toastr-icon">
                    <template x-if="type === 'success'">
                        <svg class="size-6 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="11" stroke="#11FFB6" stroke-opacity="0.231373" stroke-width="2"></circle>
                            <path d="M8.45703 12.6263L10.332 14.7096L15.5404 9.29297" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </template>
                    <template x-if="type === 'error'">
                        <svg class="size-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="11" stroke="#FF9500" stroke-opacity="0.25" stroke-width="2"></circle>
                            <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v5"></path>
                            <path fill="#fff" stroke="#fff" d="M12.5 16.5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
                        </svg>
                    </template>
                </div>
                <div class="toastr-message" x-text="message"></div>
                <button @click="show = false" class="toastr-button reset">Close</button>
            </div>
        </template>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('toastr', ({ message, type = 'info', timeout = 5000 }) => {
                Alpine.store('toastr', { show: true, message, type, timeout });
            });
        });
    </script>
</div>