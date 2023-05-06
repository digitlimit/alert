@php 
  $tag   = $attributes->get('tag', $defaultTag); 
  $id    = $attributes->get('id', $id); 
  $modal = $alert->tagged('modal', $tag);
@endphp
@if($modal)
  <div id="{{ $id }}" {{ $attributes->merge(['class' => 'modal fade show']) }}
    data-bs-backdrop="static" 
    data-bs-keyboard="false" 
    {{-- style="display: block;" --}}
    tabindex="-1" 
    aria-hidden="true"
  >
    @if ($slot->isNotEmpty())
      {{ $slot }}
    @else
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">

            @if($modal->title)
              <h5 class="modal-title">
                {{ $modal->title }}
              </h5>
            @endif

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            {{ $modal->message }}
          </div>

          <div class="modal-footer">

            @if($modal->cancel)
              @if($modal->cancel->link())
                <a href="{{ $modal->cancel->link() }}" {{ $cancelAttributes($modal->cancel->attributes()) }}>
                  {{ $modal->cancel->label() }}
                </a>
              @else
                <button {{ $cancelAttributes($modal->cancel->attributes()) }}>
                  {{ $modal->cancel->label() }}
                </button>
              @endif
            @endif

            @if($modal->action)
              @if($modal->action->link())
                <a href="{{ $modal->action->link() }}" {{ $actionAttributes($modal->action->attributes()) }}>
                  {{ $modal->action->label() }}
                </a>
              @else
                <button {{ $actionAttributes($modal->action->attributes()) }}>
                  {{ $modal->action->label() }}
                </button>
              @endif
            @endif
          </div>
          
        </div>
      </div>
    @endif
  </div>
 {{-- <script>
  (function () {

    var modal = document.querySelector('#{{$id}}');

    modal.addEventListener('shown.bs.modal', function () {
      alert(8)
    });

  })();
  </script> --}}
@endif