@php
    $name  = $attributes->get('name', '');
    $tag   = $attributes->get('tag', $defaultTag);
    $field = $alert->named('field', $name, $tag) ?? $alert->tagged('field', $tag);
    $bag   = $alert->tagged('bag', $tag);
@endphp

@if($slot->isNotEmpty())
    {{ $slot }}
@elseif($field && $field->name == $name)
    <div {{ $attributes->merge(['class' => 'form-text text-'.$field->level]) }}>
        {{ $error ?? $field->message }}
    </div>
@elseif($bag && $bag->messageFor($name))
    <div {{ $attributes->merge(['class' => 'form-text text-'.$bag->level]) }}>
        {{ $bag->messageFor($name) }}
    </div>
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