@php 
  $tag    = $attributes->get('tag', $defaultTag); 
  $id     = $attributes->get('id', $id); 
  $modal  = $alert->tagged('modal', $tag);

  $dialog = $modal->dialog ?? '';
  $cancel = $modal->cancel ?? '';
  $action = $modal->action ?? '';
  $view   = $modal->view ?? '';
@endphp

@props([
  'header',
  'body',
  'footer'
])

@if($modal)
  <div 
    {{ $attributes->merge(['id'       => $id]) }}
    {{ $attributes->merge(['class'    => 'modal']) }}
    {{ $attributes->merge(['tabindex' => '-1']) }}
  >
    <div 
      class="modal-dialog {{ $dialog->size }} {{ $dialog->position }} {{ $dialog->scrollable }}"
    >
      <div class="modal-content">

        <div {{ isset($header) ? $header->attributes->class(['modal-header']) : 'class=modal-header' }}>
          @if (isset($header) && $header->isNotEmpty())
            {{ $header }}
          @elseif($modal->title)
            <h5 class="modal-title {{ $modal->level ? 'text-' . $modal->level : '' }}">
              {{ $modal->title }}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          @endif
        </div>

        @if($view)
          {!! $view !!}
        @else
          <div {{ isset($body) ? $body->attributes->class(['modal-body']) : 'class=modal-body' }}>
            @if(isset($body) && $body->isNotEmpty())
              {{ $body }}
            @elseif($modal->message)
              {{ $modal->message }}
            @endif
          </div>
        @endif

        @if(empty($action->label) && empty($cancel->label) && (isset($footer) && $footer->isEmpty()) )

          <div {{ isset($footer) ? $footer->attributes->class(['modal-footer']) : 'class=modal-footer' }}>
            @if(isset($footer) && $footer->isNotEmpty())
              {{ $footer }}
            @else

              @if($cancel->label)
                @if($cancel->link)
                  <a href="{{ $cancel->link }}" {!! $cancelAttributes($cancel->attributes) !!}>
                    {{ $cancel->label }}
                  </a>
                @else
                  <button {!! $cancelAttributes($cancel->attributes) !!}>
                    {{ $cancel->label }}
                  </button>
                @endif
              @endif

              @if($action->label)
                @if($action->link)
                  <a href="{{ $action->link }}" {!! $actionAttributes($action->attributes) !!}>
                    {{ $action->label }}
                  </a>
                @else
                  <button {!! $actionAttributes($action->attributes) !!}>
                    {{ $action->label }}
                  </button>
                @endif
              @endif

            @endif
          </div>
          
        @endif

      </div>
    </div>
  </div>
 <script>
  (function () 
  {
    var modalId      = '{{$id}}';
    var modalElement = document.querySelector('#'+modalId);

    if(!modalElement) {
      console.log('digitlimit alert: bootstrap modal with given ID ' + modalId +' not found');
      return;
    }

    if(typeof(bootstrap) == 'undefined') {
      console.log('digitlimit alert: bootstrap is not loaded on the page');
      return;
    }
    
    var modal = new bootstrap.Modal(modalElement, {
      keyboard: false
    });

    modal.show();
  })();
  </script>
@endif