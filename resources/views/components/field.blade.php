@php
    $name  = $attributes->get('name', '');
    $tag   = $attributes->get('tag', $defaultTag);

    $field = $alert->tagged('field', $tag);
    $error = $field ? $field->messageFor($name) : '';
@endphp

@if($slot->isNotEmpty())
    {{ $slot }}
@elseif($field)
    <div {{ $attributes->merge(['class' => 'form-text text-'.$field->level]) }}>
        {{ $error ?? $field->message }}
    </div>
@else
    @error($name, $tag)
        <div {{ $attributes->merge(['class' => 'form-text text-danger']) }}>
            {{ $errors->$tag->first($name) }}
        </div>
    @enderror

    @error($name)
        <div {{ $attributes->merge(['class' => 'form-text text-danger']) }}>
            {{ $errors->first($name) }}
        </div>
    @enderror
@endif