<div wire:ignore class="digitlimit-alert-field">
    <div
            x-transition.duration.300ms
            x-show="field.message"
            x-data="{
            field: {},
            alert: {{ $alert ?? '{}' }},
            setField() {
                this.field = this.alert
            },
            init() {
                this.setField();
            },
        }"

            class="alert-field p-3"
            :class="field.level"
            @open-alert-field.window="setField()"
            role="alert"
    >
        <span x-text="field.message"></span>
    </div>
</div>
