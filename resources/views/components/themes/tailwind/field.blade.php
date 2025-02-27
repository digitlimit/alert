<div class="digitlimit-alert-field">
    @inject('alert', 'Digitlimit\Alert\Alert')
    @php
        $field  = $alert->fromArray($data);
        $bag    = $alert->taggedBag($tag);

        $level = null;
        $message = null;

        if ($field->name == $name) {
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

            @open-alert-field-{{ $field->getName() }}.window="show = true"

            role="alert"
        >
            {{ $message }}
        </div>
    @endif
</div>