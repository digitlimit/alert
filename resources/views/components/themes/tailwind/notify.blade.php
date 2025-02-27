<div class="digitlimit-alert-notify">
    @inject('alert', 'Digitlimit\Alert\Alert')
    @php
        $notify    = $alert->fromArray($data);
        $position   = config('alert.tailwind.classes.notify.position.' . $notify->getPosition());
        $container = config('alert.tailwind.classes.notify.levels.' . $notify->getLevel() . '.container');
    @endphp
    <div

            x-data="{
            position: 'top-right',
            notifications: $store.notifications?.list || [],
            counter: 0,
            createNotification(message, type = 'info', timer = 2000) {
                const index = this.notifications.length;
                let totalVisible = this.notifications.filter(notify => notify.visible).length + 1;

                this.notifications.push({
                    id: this.counter++,
                    message,
                    type,
                    timeOut: timer * totalVisible,
                    visible: true
                });

                setTimeout(() => {
                    this.destroyNotification(index);
                }, timer * totalVisible);
            },

            destroyNotification(index) {
                 this.notifications[index].visible = false;
            },

            closeNotification(id) {
                const notification = this.notifications.find(notify => notify.id === id);
                if (notification) {
                    notification.visible = false;
                }
            }
        }"

            x-init="
            $store.notifications = $data;

            createNotification(
                '{{ $notify->getMessage() }}',
                '{{ $notify->getLevel() }}',
                2000
            );
        "

            @open-alert-notify.window="createNotification('{{ $notify->getMessage() }}', '{{ $notify->getLevel() }}', 2000)"

            x-cloak

            class="absolute {{ $position }} px-2 mt-3 overflow-x-hidden z-50"
    >
        <template x-for="notify in notifications" :key="notify.id">
            <div
                    x-show="notify.visible"
                    x-transition:enter="transition ease-in duration-200"
                    x-transition:enter-start="transform opacity-0 translate-y-2"
                    x-transition:enter-end="transform opacity-100"
                    x-transition:leave="transition ease-out duration-500"
                    x-transition:leave-start="transform translate-x-0 opacity-100"
                    x-transition:leave-end="transform -translate-y-2 opacity-0"
                    class="{{ $container }}"
            >
                <div class="flex flex-col w-full">
                    <div class="flex items-center w-full px-1 my-2">
                        <div class="self-start px-1">
                            <svg x-show="notify.type == 'info'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="notify.type == 'success'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="notify.type == 'warning'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="notify.type == 'error'" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>

                        <div x-text="notify.message"></div>

                        <div class="self-start px-1">
                            <button type="button" class="pt-0 px-1" @click="closeNotification(notify.id)">
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
                            }, notify.timeOut / 100)
                        "
                            max="100"
                            :value="value"
                            class="w-full h-1 p-0">
                    </progress>
                </div>
            </div>
        </template>
    </div>
</div>
