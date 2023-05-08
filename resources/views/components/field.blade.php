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
@endif