<div class="digitlimit-alert-field">
    @inject('alert', 'Digitlimit\Alert\Alert')
    @php
        $field   = $alert->fromArray($data);
        $bag     = $alert->fieldBag($tag);
        $level   = null;
        $message = null;

        if ($field && $field->getName() == $name) {
            $level = $field->getLevel();
            $message = $field->getMessage();
        } elseif($bag && $bag->messageFor($name)) {
            $level = $bag->getLevel();
            $message = $bag->messageFor($name);
        }
    @endphp

    @if($level && $message)
        <div
                id="{{ $field->getId() }}"

                class="{{ config("alert.tailwind.classes.field.levels.$level.container") }}"

                x-transition.duration.300ms

                x-data="{show: true}"

                x-show="show"

                @open-alert-field.window="show = true"

                role="alert"
        >
            {{ $message }}
        </div>
    @elseif($error)
        <div
                class="{{ config("alert.tailwind.classes.field.levels.error.container") }}"

                x-transition.duration.300ms

                x-data="{show: true}"

                x-show="show"

                @open-alert-field.window="show = true"

                role="alert"
        >
            {{ $error }}
        </div>
    @endif
</div>
