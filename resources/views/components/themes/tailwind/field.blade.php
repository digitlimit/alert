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
        <div class="{{ $levels[$level]['classes']['main'] }}">
            {{ $message }}
{{--                <strong>Success:</strong>--}}
        </div>
    @endif
</div>