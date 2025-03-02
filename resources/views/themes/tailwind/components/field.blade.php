<div class="p-3" wire:ignore class="digitlimit-alert-field">
        @inject('alert', 'Digitlimit\Alert\Alert')
        @php
                $field   = $data ? $alert->fromArray($data) : null;
                $bag     = $data ? $alert->fieldBag($tag): null;

                if ($field && $field->getName() == $name) {
                    $level = $field->getLevel();
                    $message = $field->getMessage();
                } elseif($bag && $bag->messageFor($name)) {
                    $level = $bag->getLevel();
                    $message = $bag->messageFor($name);
                } else {
                    $level = null;
                    $message = null;
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
        @elseif($errors->has($name))
                <div
                        class="{{ config("alert.tailwind.classes.field.levels.error.container") }}"

                        x-transition.duration.300ms

                        x-data="{show: true}"

                        x-show="show"

                        @open-alert-field.window="show = true"

                        role="alert"
                >
                        {{ $errors->first($name) }}
                </div>
        @endif
</div>
