@if (Alert::has('notify'))
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-{{Alert::status()}} bottom-space show">

                        @if(Alert::closable())
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        @endif

                        @if(!Alert::title()  && Alert::icon())
                                <i class="{{Alert::icon()}}"></i>
                        @elseif(Alert::title())
                            <strong>
                                @if(Alert::icon())<i class="{{Alert::icon()}}"></i>@endif
                                {{Alert::title()}}
                            </strong>
                        @endif
                        {!!Alert::message()!!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endif