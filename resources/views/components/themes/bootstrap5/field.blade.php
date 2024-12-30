@php
    $name  = $attributes->get('name');
    $tag   = $attributes->get('tag', $defaultTag);
    $field = $alert->named('field', $name, $tag) ?? $alert->tagged('field', $tag);
    $bag   = $alert->tagged('bag', $tag);
@endphp

@if($slot->isNotEmpty())
    {{ $slot }}
@elseif($field && $field->name == $name)
    <div {{ $attributes->merge(['class' => 'form-text text-'.$field->getLevel()]) }}>
        {{ $error ?? $field->getMessage() }}
    </div>
@elseif($bag && $bag->messageFor($name))
    <div {{ $attributes->merge(['class' => 'form-text text-'.$bag->getLevel()]) }}>
        {{ $bag->messageFor($name) }}
    </div>
@elseif(isset($errors))
    @php
        $level = $field->getLevel() ?? 'danger';
    @endphp

    @error($name, $tag)
        <div {{ $attributes->merge(['class' => 'form-text text-'.$level ]) }}>
            {{ $errors->$tag->first($name) }}
        </div>
    @enderror

    @if(empty($tag))
        @error($name)
            <div {{ $attributes->merge(['class' => 'form-text text-'.$level ]) }}>
                {{ $errors->first($name) }}
            </div>
        @enderror
    @endif
@endif