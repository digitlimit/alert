@if (Alert::has('form'))

    <div class="alert alert-{{Alert::status()}}" style="display: block;">

        @if(Alert::closable())
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @endif

        @if(Alert::title())
            <strong>
                @if(Alert::icon())<i class="{{Alert::icon()}}"></i>@endif
                {{Alert::title()}}
            </strong>
        @endif

        {!!Alert::message()!!}

    </div>

@endif
