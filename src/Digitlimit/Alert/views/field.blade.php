@if($errors->has($field))
    <p class="help-block field-error" style="color:rgba(255, 35, 14, 0.73)">
        @if(isset($tag) && $tag)
            {{ $errors->${$tag}->first($field) }}
        @else
            {{ $errors->first($field) }}
        @endif
    </p>
@endif