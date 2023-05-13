@php
    $name  = $attributes->get('name', '');
    $tag   = $attributes->get('tag', $defaultTag);
    $field = $alert->tagged('field', $tag);
@endphp

@if($slot->isNotEmpty())
    {{ $slot }}
@elseif($field)
    @if($field->name && $field->name == $name)
        <div {{ $attributes->merge(['class' => 'form-text text-'.$field->level]) }}>
            {{ $error ?? $field->message }}
        </div>
    @endif
@else
    @php
        $level = $field->level ?? 'danger';
    @endphp

    @error($name, $tag)
        <div {{ $attributes->merge(['class' => 'form-text text-'.$level ]) }}>
            {{ $errors->$tag->first($name) }}
        </div>
    @enderror

    @error($name)
        <div {{ $attributes->merge(['class' => 'form-text text-'.$level ]) }}>
            {{ $errors->first($name) }}
        </div>
    @enderror
@endif