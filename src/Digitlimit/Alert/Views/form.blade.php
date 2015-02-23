@if (Session::has('alert_form_message'))

    <div class="alert alert-{{Session::get('alert_message_status')}}" style="display: block;">

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

@endif
