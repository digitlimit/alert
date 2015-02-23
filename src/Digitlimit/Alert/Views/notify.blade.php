@if (Session::has('alert_notify_message'))

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-{{Session::get('alert_message_status')}} bottom-space show">

                        @if(Session::get('alert_message_closable'))
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        @endif

                        @if(Session::get('alert_message_title'))
                            <strong>
                                @if(Session::get('alert_message_icon'))<i class="{{Session::get('alert_message_icon')}}"></i>@endif
                                {{Session::get('alert_message_title')}}
                            </strong>
                        @endif
                        {!!Session::get('alert_message')!!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endif