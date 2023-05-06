@php
    $tag   = $attributes->get('tag', $defaultTag);
    $field = $alert->tagged('field', $tag);
@endphp

@if($slot->isNotEmpty())
    {{ $slot }}
@elseif($field)
    <div {{ $attributes->merge(['class' => 'form-text text-'.$field->level]) }}>
        {{ $field->message }}
    </div>
@endif