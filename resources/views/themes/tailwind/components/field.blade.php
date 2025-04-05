<div class="digitlimit-alert-field">
    <div
        x-transition.duration.300ms
        x-data="{
            field: @entangle('alert'),
        }"
        x-init="$watch('field.message', message => {
            if (message && field.timeout) {
                clearTimeout(timeoutHandle); // clear any previous timers
                timeoutHandle = setTimeout(() => {
                    field.message = '';
                    field.level = '';
                    field.timeout = null;
                    console.log('timeout cleared');
                }, field.timeout);
            }
        })"
        class="alert-field pl-0"
        :class="field.level"
        role="alert"
    >
        <span x-text="field.message"></span>
    </div>
</div>
