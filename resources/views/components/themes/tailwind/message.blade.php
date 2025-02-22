<div class="digitlimit-alert-message">
    @inject('alert', 'Digitlimit\Alert\Alert');
    @php
        $message  = $alert->fromArray($data);
        $header = $header ?? null;
        $body   = $body ?? null;
        $footer = $footer ?? null;

        $id        = $id ?? $message->id;
        $cancel    = $message->cancel ?? '';
        $action    = $message->action ?? '';
        $view      = $message->view ?? '';

        $hasBody   = !is_null($body);
        $hasHeader = !is_null($header);
        $hasFooter = !is_null($footer);

        $hasTitle  = $hasHeader || $message->getTitle();
    @endphp
{{--@if($message)--}}
{{--    @php--}}
{{--        $id = $id ?? $message->id;--}}
{{--    @endphp--}}
{{--    <div data-bs-theme="{{$theme}}" id="{{$id}}" {{ $attributes->merge(['class' => 'alert alert-dismissible alert-'.$message->getLevel()]) }} role="alert">--}}
{{--        @if ($slot->isNotEmpty())--}}
{{--            {{ $slot }}--}}
{{--        @else--}}
{{--            @if($message->getTitle())<strong>{{ $message->getTitle() }}</strong>@endif {{ $message->getMessage() }}--}}
{{--            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--@endif--}}

    <div
        x-data="{ show: true }"

        x-show="show"

        x-transition.duration.300ms

        x-init="() => {
           modalOpen = true;
        }"

        @open-alert-modal.window="modalOpen = true"

        class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
        role="alert"
    >
        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>

        <span class="sr-only">Info</span>

        <div class="ms-3 text-sm font-medium">
            A simple info alert with an <a href="#" class="font-semibold underline hover:no-underline">example link</a>. Give it a click if you like.
        </div>

        <button
            @click="show = false"
            type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
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
