@if (Alert::has('sticky'))
    <div class="alert alert-{{Alert::status()}}" style="display: block; margin-bottom:0; border: 0; padding-top: 5px; padding-bottom: 5px;">

        @if(Alert::closable())
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @endif

        @if(Alert::title())
            <strong>
                @if(Alert::icon())<i class="{{Alert::icon()}}"></i>@endif
                {{Alert::title()}}
            </strong>
        @endif

        {!!Alert::sticky_message()!!}

    </div>
@endif