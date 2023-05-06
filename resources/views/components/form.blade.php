@php
    $tag = $attributes->get('tag', $defaultTag);
    $form = $alert->tagged('form', $tag);
@endphp
@if($form)
    <div {{ $attributes->merge(['class' => 'alert alert-'.$form->level]) }} role="alert">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($form->title)<strong>{{ $form->title }}</strong>@endif {{ $form->message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
@endif