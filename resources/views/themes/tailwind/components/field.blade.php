<div wire:ignore class="digitlimit-alert-field">
    <div
        x-transition.duration.300ms
        x-show="field.message"
        x-data="{
            field: {},
            alert: {{ $alert ?? '{}' }},
            setField() {
                this.field = this.alert
                console.log('setField', this.field)
            },
            init() {
                this.setField();
            },
        }"

        class="alert-field p-3"
        :class="field.level"
        role="alert"
        @open-alert-field.window="setField()"
    >
        <span x-text="field.message"></span>
    </div>
</div>
