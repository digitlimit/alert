@php
    $name  = $attributes->get('name', '');
    $tag   = $attributes->get('tag', $defaultTag);
    $field = $alert->named('field', $name, $tag) ?? $alert->tagged('field', $tag);
@endphp

@if($slot->isNotEmpty())
    {{ $slot }}
@elseif($field)
    @if(($name && $field->name == $name) || empty($name))
        <div {{ $attributes->merge(['class' => 'form-text text-'.$field->level]) }}>
            {{ $error ?? $field->message }}
        </div>
    @elseif($field->messageFor($name))
        <div {{ $attributes->merge(['class' => 'form-text text-'.$field->level]) }}>
            {{ $field->messageFor($name) }}
        </div>
    @endif
@elseif(isset($errors))
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