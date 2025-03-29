<div class="digitlimit-alert-field">
    <div
        x-transition.duration.300ms
        x-data="{
            field: @entangle('alert'),
            dismiss(id) {
                console.log(id);
            }
        }"

        class="alert-field pl-0"
        :class="field.level"
        role="alert"
    >
        <span x-text="field.message"></span>
    </div>
</div>
