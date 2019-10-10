@if(Alert::has('form'))

    <div class="alert alert-{{Alert::status()}}

        @if(Alert::closable()) alert-dismissible @endif fade show" role="alert">

        @if(Alert::icon())<i class="{{Alert::icon()}}"></i>@endif

        @if(Alert::title())<strong>{{Alert::title()}}</strong>@endif {{Alert::message()}}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
