@if ( Session::has('alert_modal_message') )

    <div class="modal fade" id="alert-modal-message" tabindex="-1" role="dialog" aria-labelledby="alert-modal-message" aria-hidden="true">
        <div class="modal-dialog {{Session::get('alert_message_modal_size')}}">
            <div class="modal-content">

                <div class="modal-header">

                    @if(Session::get('alert_message_closable'))
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    @endif

                    @if(Session::get('alert_message_title'))
                        <h4 class="modal-title  @if(Session::get('alert_message_status'))modal-{{Session::get('alert_message_status')}}@endif" id="alert-modal-message-title">
                            @if(Session::get('alert_message_icon'))<i class="{{Session::get('alert_message_icon')}}"></i>@endif
                            {{Session::get('alert_message_title')}}
                        </h4>
                    @endif
                </div>

                <div class="modal-body">
                    @if(Session::get('alert_message_modal_view'))
                        @include(Session::get('alert_message_modal_view'))
                    @else
                        {!!Session::get('alert_message')!!}
                    @endif
                </div>

                <div class="modal-footer">

                    @if(Session::get('alert_message_close_button_label'))
                        @if(Session::get('alert_message_close_button_url'))
                            <a href="{{Session::get('alert_message_close_button_url')}}" type="button" class="btn btn-ar btn-default" data-dismiss="modal">
                                {{Session::get('alert_message_close_button_label')}}
                            </a>
                        @else
                            <button type="button" class="btn btn-ar btn-default" data-dismiss="modal">
                                {{Session::get('alert_message_close_button_label')}}
                            </button>
                        @endif
                    @endif



                    @if(Session::get('alert_message_action_button_label'))
                        @if(Session::get('alert_message_action_button_url'))
                            <a href="{{Session::get('alert_message_action_button_url')}}" type="button" class="btn btn-ar btn-primary">
                                {{Session::get('alert_message_action_button_label')}}
                            </a>
                        @else
                            <button type="button" class="btn btn-ar btn-primary">{{Session::get('alert_message_action_button_label')}}</button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

@endif