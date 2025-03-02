<div wire:ignore class="digitlimit-alert-message">
    @inject('alert', 'Digitlimit\Alert\Alert')
    @php
        $message   = $alert->fromArray($data);
        $level     = $message->getLevel();
        $close     = config("alert.tailwind.classes.message.levels.$level.close");
        $container = config("alert.tailwind.classes.message.levels.$level.container");
    @endphp
    <div
            id="{{ $message->getId() }}"

            class="{{ $container }}"

            x-transition.duration.300ms

            x-data="{
                show: true
            }"

            x-show="show"

            @open-alert-message.window="show = true"

            role="alert"
    >
        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>

        <span class="sr-only">{{ ucwords($message->getLevel()) }}</span>

        {{ $slot ?? '' }}

        <div class="ms-3 text-sm font-medium">
            @if($message->hasTitle())
                <h3 class="text-lg font-semibold">{{ $message->getTitle() }}</h3>
            @endif

            <p>{{ $message->getMessage() }}</p>
        </div>

        <button
                @click="show = false"
                type="button"
                class="{{ $close }}"
                aria-label="Close"
        >
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
            </svg>
        </button>
    </div>
</div>
